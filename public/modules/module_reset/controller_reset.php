<?php

class ControllerReset extends ControleurGenerique {
    
    function __construct () {
        require_once 'params_co.php';
        $this->modele = new ModeleReset($dsn, $user, $password); 
        $this->vue = new VueReset();
        $this->action();
    }
    
    function action() {
        if (!isset($_GET["p"]) || isset($_SESSION['pseudo']))
            header('Location: index.php');

        $message = NULL;

        if (isset($_POST["newPassword"]) && isset($_POST["newPasswordRepeat"])) { //si submit
            $message = $this->modele->changePassword();

            if ($message == NULL) //Si le changement de mot de passe a été effectué
                header('Location: index.php?logout');
        }
        
        $this->vue->loadPage($message);
    }
}

?>
