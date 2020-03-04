<?php

class ControllerCreate extends ControleurGenerique {

    function __construct () {
    	require_once 'params_co.php';
        $this->modele = new ModeleCreate($dsn, $user, $password); 
        $this->vue = new VueCreate();
        $this->action(); 
    }

	function action() {
        $message = NULL;

        if (!isset($_COOKIE['conversationID']) || empty($_COOKIE['conversationID'])) {
            $key = $this->modele->generateKey(); 
            setcookie('conversationID', $key);
        } else {
            $key = $_COOKIE['conversationID'];
        }

        if (isset($_POST["name"])) { //Si submit
            $message = $this->modele->saveConversationID($key);
            
            if ($message == NULL) //Si il n'y pas eu de problèmes
                header('Location: index.php?module=module_invite');
        } 
        $this->vue->loadPage($message, $key); 
	}
}

?>
