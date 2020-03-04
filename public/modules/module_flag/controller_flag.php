<?php

class ControllerFlag extends ControleurGenerique {

    function __construct () {
    	require_once 'params_co.php';
        $this->modele = new ModeleFlag($dsn, $user, $password); 
        $this->vue = new VueFlag();
        $this->action();
    }

    function action() {
        $message = NULL;

        if (!empty($_POST)) { //Si submit
            $message = $this->modele->unleashHell();

            if ($message == NULL) //Si il n'y pas eu de problèmes
                header('Location: index.php');
        } 

        $this->vue->loadPage($this->modele->getFlaggedMessages(), $message);
    }
}

?>
