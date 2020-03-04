<?php

class ControllerProfile extends ControleurGenerique {
    
    function __construct() {
        require_once 'params_co.php';
        $this->modele = new ModeleProfile($dsn, $user, $password); 
        $this->vue = new VueProfile();
        $this->action();
    }

    function action() {
        $this->vue->setInfo($this->modele->getProfileInfo());
        $this->vue->loadPage();
    }
}

?>
