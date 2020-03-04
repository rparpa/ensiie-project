<?php

class ControllerContact extends ControleurGenerique {

    function __construct () {
    	require_once 'params_co.php';
        $this->modele = new ModeleContact($dsn, $user, $password); 
        $this->vue = new VueContact();
        $this->action();
    }
    
    function action() {
        $message = NULL;

        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["content"])) { //Si submit
            $message = $this->modele->sendEmail();

            if ($message == NULL) //Si l'email s'est envoyé avec succès
                header('Location: index.php');
        }

        $this->vue->loadPage($message);
    }
}

?>
