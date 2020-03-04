<?php

class ModeleReset extends ModeleGenerique {
    
    function changePassword () {
        if (empty($_POST["newPassword"]) || empty($_POST["newPasswordRepeat"])) {
            return 'Please enter the passwords';
        } else {
            $oldPassword = htmlspecialchars($_GET['p']);
            $newPassword = hash('sha512', htmlspecialchars($_POST["newPassword"]));
            $newPasswordRepeat = hash('sha512', htmlspecialchars($_POST["newPasswordRepeat"]));
        }

        $req = $this->connexion->prepare('SELECT * FROM Utilisateur WHERE password = ?');
        $data = array($oldPassword); 
        $req->execute($data);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result == false || $oldPassword != $result['password']) {
            return 'Something went wrong !';
        } else {
            if ($newPassword != $newPasswordRepeat) {
                return 'The two passwords do not match !';
            } else {
                $private_key = openssl_pkey_new();
                $public_key = openssl_pkey_get_details($private_key)['key'];
                $private_key_string = '';
                openssl_pkey_export($private_key, $private_key_string, $_POST["newPassword"]);
                $req = $this->connexion->prepare("UPDATE Utilisateur SET password = :newPassword, private_key = :private_key, public_key = :public_key WHERE password = :oldPassword;");
                $stmt = $req->execute(array(
                    'oldPassword' => $oldPassword,
                    'newPassword' => $newPassword,
                    'private_key' => $private_key_string,
                    'public_key' => $public_key));

			    // Remove references to the user's old key.
                $req_request_convs_reencrypt = $this->connexion->prepare('DELETE FROM Messages_Decryption_Keys WHERE idPersonne = :idUser');
                $req_request_convs_reencrypt->execute(array(
                    'idUser' => $result['idUser']));
                
                if (!$stmt)
                    return 'Something went wrong !';
            }
        }
        return NULL;
    }
}

?>
