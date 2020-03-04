<?php

class ModeleChat extends ModeleGenerique {

    //
    // /!\ ATTENTION: Répétition de code, malheureusement pas eu le temps de nettoyer cela /!\
    //
    function getConversations() {
        $tab = array();

        if (isset($_SESSION['id']) && ! empty($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else if (isset($_COOKIE['idUser']) && ! empty($_COOKIE['idUser'])) {
            $id = $_COOKIE['idUser'];
        } else {
            return 'Error';
        }

        $req = $this->connexion->prepare("SELECT nomConv, cleConversation FROM Conversation INNER JOIN Participe USING(cleConversation) WHERE Participe.idUser = ?");
        $req->execute(array($id));

        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            $tab[$result["cleConversation"]] = $result["nomConv"];
        }

        return $tab;
    }

    function getRoomName() {
        $req = $this->connexion->prepare("SELECT nomConv FROM Conversation WHERE cleConversation = ?");
        $req->execute(array($_GET['key']));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["nomConv"] : NULL;
    }

    function sendMessage($message, $key) {
        $req = $this->connexion->prepare('INSERT INTO Message (dateEmis, contenu, idUser, cleConversation) VALUES (DEFAULT, :contenu, :idUser, :cle)');

        if (isset($_SESSION['id']) && ! empty($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else if (isset($_COOKIE['idUser']) && ! empty($_COOKIE['idUser'])) {
            $id = $_COOKIE['idUser'];
        } else {
            return 'Error';
        }

        if ($key != $_COOKIE['conversationKey'] || ! array_key_exists($key, $this->getConversations())) {
            return 'Error';
        }

        // Encrypt the message.
        $res = $this->getConversationMembersPublicKeys($key);
        $public_keys = $res[0];
        $keys_user_ids = $res[1];
        $message_encrypted = "";
        openssl_seal($message, $message_encrypted, $env_keys, $public_keys);

        $data = array(
            'contenu' => $message_encrypted,
            'idUser' => $id,
            'cle' => $key
        );

        $test = $req->execute($data);
        $message_id = $this->connexion->lastInsertId();

        if (! $test)
            return "Error";

        $this->insertMessageKeys($message_id, $env_keys, $keys_user_ids);

        return NULL;
    }

    function loadMessages ($id, $key) {
        $req = $this->connexion->prepare("SELECT idMessage, dateEmis, contenu, pseudo, idUser FROM Message INNER JOIN Utilisateur USING (idUser) WHERE cleConversation= :cle AND idMessage > :id ORDER BY idMessage LIMIT 0,20");
        $req->execute(array(
            ":cle" => $key,
            ":id" => $id));

        $messages = array();
        
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $data["siAuteur"] = $data["pseudo"] == $_SESSION["pseudo"];

            $test = glob('uploads/avatar' . $data["idUser"] . '*');
            if(!empty($test))
                $data["avatar"] = $test[0];
            else
                $data["avatar"] = 'include/templates/images/user.png';

            $decrypted_message = $this->decryptMessage($data["idMessage"], $data["contenu"]);

            if ($decrypted_message !== null){
                $data["contenu"] = $decrypted_message;
                array_push($messages, $data);
            }
        }
        
        echo json_encode($messages);
    }

    function sendFile () {
        if (isset($_FILES["file"]) && isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (!isset($_FILES["file"]["tmp_name"]) || empty($_FILES["file"]["tmp_name"])) {
                return "Sorry there was a problem with your image, try another one.";
            }

            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check == false) {
                return "File is not an image.";
            }
            
            // Check file size
            if ($_FILES["file"]["size"] > 1000000) { //1mo
                return "Sorry, your file is too large.";
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
            else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    return "ok";
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            }
        } else
            return "Sorry, there was an error uploading your file.";
    }

    function deleteMessage () { 
        $test = $this->checkMessageOwner();

        if ($test) { //si un message du mm user
            $req = $this->connexion->prepare('DELETE FROM Message WHERE idMessage = ?');
            $req->execute(array($_COOKIE['messageId']));
            $req = $this->connexion->prepare('DELETE FROM Messages_Decryption_Keys WHERE idMessage = ?');
            $req->execute(array($_COOKIE['messageId']));
        }

        echo htmlspecialchars($_COOKIE["messageId"]);
    }

    function flagMessage () { 
        $test = $this->checkMessageOwner();

        if (!$test) { //si pas un message du mm user qui report
            $idMessage = $_COOKIE['messageId'];

            $req = $this->connexion->prepare('SELECT * FROM Flagged_Messages WHERE idMessage = ?');
            $data = array($idMessage);
            $req->execute($data);
            $result = $req->fetch(PDO::FETCH_ASSOC);

            if (!empty($result))
                echo "This message has already been reported";
            else {
                $req = $this->connexion->prepare("INSERT INTO Flagged_Messages (idFlag, idMessage) VALUES (DEFAULT, ?)");
                $req->execute(array($idMessage));

                // Reencrypt the message with the admin keys so they can read it.
                // Get conversation key.
                $req_get_conversation_key = $this->connexion->prepare("SELECT cleConversation FROM Message WHERE idMessage = :idMessage");
                $req_get_conversation_key->execute(array(
                    ":idMessage" => $idMessage));
                $key = $req_get_conversation_key->fetch()['cleConversation'];

                $this->re_encrypt_message($key, $idMessage, $this->get_admin_keys());

                echo "Your report has been notified";
            }
        }
    }

    function checkMessageOwner () {
        $messageId = htmlspecialchars($_COOKIE["messageId"]);

        $req = $this->connexion->prepare('SELECT * FROM Message WHERE idMessage = :id AND idUser = :id2');
        $req->execute(array(
            'id' => $messageId,
            'id2' => $_SESSION['id']));

        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    function deleteFromConversation() {
        $key=$_COOKIE['key']; 
        $id = $_SESSION['id']; 
        $req=$this->connexion->prepare('DELETE FROM Participe WHERE idUser = :id and cleConversation = :cle'); 
        $req->execute(array(
        'id' => $id, 
        'cle' => $key));
    }
}

?>
