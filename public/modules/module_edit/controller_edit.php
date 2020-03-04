<?php

class ControllerEdit extends ControleurGenerique {

    function __construct() {
    	require_once 'params_co.php';
        $this->modele = new ModeleEdit($dsn, $user, $password); 
        $this->vue = new VueEdit();
        $this->action();
    }

    function action() {
        $message = NULL;

	    if (!empty($_POST)) { //Si submit
            $message = $this->modele->editProfile();

            if ($message == NULL) //Si il n'y pas eu de problèmes
            	header('Location: index.php?module=module_profile');
        }
        
        $this->vue->setInfo($this->modele->getProfileInfo());
        $this->vue->loadPage($message);
    }
}

?>