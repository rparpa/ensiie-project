<?php

class ControllerSignin extends ControleurGenerique {

    function __construct() {
    	require_once 'params_co.php';
        $this->modele = new ModeleSignin($dsn, $user, $password); 
        $this->vue = new VueSignin();
        $this->action();
    }

    function action() {
        $message = NULL;

        if (isset($_POST["pseudo"]) && isset($_POST["password"])) //Si submit
            $message = $this->modele->connection();

        if (isset($_SESSION['pseudo'])) //Si utilisateur connecté redirect
            header('Location: index.php');
        
        $this->vue->loadPage($message);
    }
}

?>
