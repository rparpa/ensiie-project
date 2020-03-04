<?php

class ControllerRegister extends ControleurGenerique {
    
    function __construct() {
    	require_once 'params_co.php';
        $this->modele = new ModeleRegister($dsn, $user, $password);
        $this->vue = new VueRegister();
        $this->action();
    }

    function action() {
        $message = NULL;

        if (isset($_POST["pseudo"]) && isset($_POST["password"])) //Si submit
            $message = $this->modele->registerUser();

        if (isset($_SESSION['pseudo'])) //Si utilisateur connecté redirect
            header('Location: index.php');
        
        $this->vue->loadPage($message);
    }
}

?>
