<?php

class ControllerJoin extends ControleurGenerique {
    
    function __construct() {
        require_once 'params_co.php';
        $this->modele = new ModeleJoin($dsn, $user, $password); 
        $this->vue = new VueJoin();
        $this->action();
    }

    function action() {
        $message = NULL;

        if (isset($_POST["key"])) { //Si submit
            $message = $this->modele->joinConversation();

            if ($message == NULL) //Si il n'y pas eu de problèmes
                header('Location: index.php?module=module_chat&key=' . $_POST["key"]);
        }

        $this->vue->loadPage($message);
    }
}

?>