<?php

class ControllerForgot extends ControleurGenerique {
    
    function __construct () {
        require_once 'params_co.php';
        $this->modele = new ModeleForgot($dsn, $user, $password); 
        $this->vue = new VueForgot();
        $this->action();
    }

    function action() {
        if (isset($_SESSION['pseudo']))
            header('Location: index.php');

        $message = null;

        if (isset($_POST["email"])) { //Si submit
            $message = $this->modele->sendEmail();

            if ($message == NULL) //Si l'email a bien été envoyé
                header('Location: index.php');
        }
        
        $this->vue->loadPage($message);
    }
}

?>