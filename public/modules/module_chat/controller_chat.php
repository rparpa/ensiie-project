<?php

class ControllerChat extends ControleurGenerique {
    
    function __construct () {
        require_once 'params_co.php';
        $this->modele = new ModeleChat($dsn, $user, $password);
        $this->vue = new VueChat();
        $this->action();
    }

    function action() {
        if (isset($_POST["data"])) { //Si JSON, donc si déjà sur la page
            $data = json_decode($_POST["data"]);
            // Checking for messages to reencrypt should be pretty lightweight, so doing it all the time should'nt be a problem?
            $this->modele->reencrypt_conversations();
            if (isset($data->action)) {
                $action = $data->action;
                if ($action == "load") {
                    $id = $data->id;
                    $key = $data->key;
                    setcookie('conversationKey', $key);
                    $this->modele->loadMessages($id, $key);
                } else if ($action == "send") {
                    $message = $data->message;
                    $key = $data->key;
                    $this->modele->sendMessage(htmlspecialchars($message), $key);
                } else if ($action == "flag") {
                    $this->modele->flagMessage();
                } else if ($action == "delete") {
                    $this->modele->deleteMessage();
                } else if ($action == "remove") {
                    $this->modele->deleteFromConversation();
                }
            }
        } else if (isset($_FILES['file'])) { //Si envoie de fichiers, donc si déjà sur la page
            $result = $this->modele->sendFile();
            if ($result == "ok") {
                $key = $_COOKIE['conversationKey'];
                $this->modele->sendMessage('<img src="uploads/' . $_FILES["file"]["name"] . '" />', $key);
            }
            echo $result;
        } else { //Sinon on charge la page html
            $conversations = $this->modele->getConversations();
            $name = $this->modele->getRoomName();
            // Bug sous linux
            if (empty($name)) {//Si la clé de conversation n'existe pas
                setcookie('conversationID', "");
                header('Location: index.php?module=module_conversations');
            }
            setcookie('idUser', $_SESSION['id']);
            $this->vue->loadPage($conversations, $name);
        }
    }
}

?>
