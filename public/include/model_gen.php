<?php

class ModeleGenerique {

	protected $connexion; 
	private $dns; 
	private $user; 
	private $password; 

	function __construct ($d,$u,$p) {
		$this->dns=$d;
		$this->user=$u;
		$this->password=$p;

		$this->init();
	}

	function init() {
		try {
			$this->connexion = new PDO($this->dns, $this->user, $this->password); 
		} catch (PDOException $e) {
			die ('Erreur : '. $e->getMessage()); 
		}	
	}
	
	function getConnexion() {
		return $this->connexion ; 
	}

    function decryptMessage($idMessage, $message)
    {
        // Get the envelope key to decrypt this message.
        $req_message_key = $this->connexion->prepare("SELECT messageKey FROM Messages_Decryption_Keys WHERE idMessage = :idMessage AND idPersonne = :idPersonne");
        $req_message_key->execute(array(
            ":idMessage" => $idMessage,
            ":idPersonne" => $_SESSION["id"]));
        $raw_key = $req_message_key->fetch();
        if($raw_key === null || !$raw_key){
        	return null;
		}
        $env_key = $raw_key['messageKey'];
        // Decrypt the message.
        $private_key = openssl_pkey_get_private($_SESSION['private_key']);
        $decryption_success = openssl_open($message, $decrypted_message, $env_key, $private_key);
        if (!$decryption_success){
            return null;
        }
        return $decrypted_message;
    }

    function getConversationMembersPublicKeys($conversation_key): array
    {
        $req_get_public_keys = $this->connexion->prepare('SELECT Utilisateur.idUser, Utilisateur.public_key FROM Utilisateur JOIN Participe P on Utilisateur.idUser = P.idUser WHERE P.cleConversation = :conversation_key');
        $data_get_public_keys = array(
            'conversation_key' => $conversation_key
        );
        $req_get_public_keys->execute($data_get_public_keys);
        $public_keys = [];
        $keys_user_ids = [];
        while($data = $req_get_public_keys->fetch(PDO::FETCH_ASSOC)){
            $public_keys[] = $data['public_key'];
            $keys_user_ids[] = $data['idUser'];
        }
        return [$public_keys, $keys_user_ids];
    }
    function insertMessageKeys($message_id, $env_keys, $keys_user_ids){
        foreach ($env_keys as $key_id => $env_key) {
            $req_insert_key = $this->connexion->prepare('INSERT INTO Messages_Decryption_Keys (idMessage, idPersonne, messageKey) VALUES (:idMessage, :idUser, :messageKey)');
            $data_insert_key = array(
                'idMessage' => $message_id,
                'idUser' => $keys_user_ids[$key_id],
                'messageKey' => $env_key
            );
            $test = $req_insert_key->execute($data_insert_key);
            if (! $test) {
                return "Error: Could not insert one of the message keys.";
            }
        }
    }

    function re_encrypt_message($conversation_key, $idMessage, $additionalKeys=null){
		// Get conversation participants public keys.
		$res = $this->getConversationMembersPublicKeys($conversation_key);
		$public_keys = $res[0];
		$keys_user_ids = $res[1];

		if ($additionalKeys !== null){
			while($data = $additionalKeys->fetch(PDO::FETCH_ASSOC)){
				$public_keys[] = $data['public_key'];
				$keys_user_ids[] = $data['idUser'];
			}
		}

		// Get the decrypted message content.
		$req_get_message_content = $this->connexion->prepare('SELECT contenu FROM Message WHERE idMessage = :idMessage');
		$data_get_message_content = array(
			'idMessage' => $idMessage
		);
		$req_get_message_content->execute($data_get_message_content);
		$message_content = $req_get_message_content->fetch()['contenu'];
		$message = $this->decryptMessage($idMessage, $message_content);

		// Re-encrypt the message.
		$message_encrypted = "";
		openssl_seal($message, $message_encrypted, $env_keys, $public_keys);
		$req_change_message_content = $this->connexion->prepare('UPDATE Message SET contenu = :contenu WHERE idMessage = :idMessage');
		$data_change_message_content = array(
			'idMessage' => $idMessage,
			'contenu' => $message_encrypted
		);
		$req_change_message_content->execute($data_change_message_content);

		// Delete the old message decryption keys
		$req_delete_old_message_keys = $this->connexion->prepare('DELETE FROM Messages_Decryption_Keys WHERE idMessage = :idMessage');
		$data_delete_old_message_keys = array(
			'idMessage' => $idMessage
		);
		$req_delete_old_message_keys->execute($data_delete_old_message_keys);
		// Add the new message decryption keys
		$this->insertMessageKeys($idMessage, $env_keys, $keys_user_ids);
    }

    function reencrypt_conversations(){
		// Recuperer les messages a qui il manque des cles de dechiffrage et qui peuvent etre rechiffrees par l'utilisateur actuel.
		$req_get_reencrypt_conversations = $this->connexion->prepare('
select Message.*, FM.idFlag from Message
    right join Participe P on Message.cleConversation = P.cleConversation
    left join Messages_Decryption_Keys MDK on Message.idMessage = MDK.idMessage and MDK.idPersonne = P.idUser
    left join Flagged_Messages FM on Message.idMessage = FM.idMessage
where (select Messages_Decryption_Keys.idKey from Messages_Decryption_Keys
       where Messages_Decryption_Keys.idMessage = Message.idMessage
         and Messages_Decryption_Keys.idPersonne = :idUser) is not null
  and MDK.idKey is null
');
		$data_get_reencrypt_conversations = array(
			'idUser' => $_SESSION["id"]
		);
		$req_get_reencrypt_conversations->execute($data_get_reencrypt_conversations);
		// Les rechiffrer.
		while($data = $req_get_reencrypt_conversations->fetch(PDO::FETCH_ASSOC)){
			if ($data['idMessage'] > 0){
				$this->re_encrypt_message($data['cleConversation'], $data['idMessage'], $this->get_admin_keys());
			}
			else {
				$this->re_encrypt_message($data['cleConversation'], $data['idMessage']);
			}
		}
	}

	function get_admin_keys(){
		$req_get_admin_keys = $this->connexion->prepare('SELECT Utilisateur.idUser, Utilisateur.public_key FROM Utilisateur RIGHT JOIN Admins A on Utilisateur.idUser = A.idUser');
		$req_get_admin_keys->execute();
		return $req_get_admin_keys;
	}
}

?>
