<?php

class ControllerPassword extends ControleurGenerique {
    
    function __construct() {
        require_once 'params_co.php';
        $this->modele = new ModelePassword($dsn, $user, $password); 
        $this->vue = new VuePassword();
        $this->action();
    }

    function action() {
        $message = null;

        if (isset($_POST["oldPassword"]) && isset($_POST["newPassword"]) && isset($_POST["newPasswordRepeat"])) { //Si submit
            $message = $this->modele->changePassword();

            if ($message == NULL) //Si le changement de mot de passe a été effectué
                header('Location: index.php?logout');
        }
        
        $this->vue->loadPage($message);
    }
}

?>
