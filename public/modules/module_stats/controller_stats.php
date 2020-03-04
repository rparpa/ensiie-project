<?php

class ControllerStats extends ControleurGenerique {
    
    function __construct () {
    	require_once 'params_co.php';
        $this->modele = new ModeleStats($dsn, $user, $password); 
        $this->vue = new VueStats(); 
        $this->action();
    }
    
	function action() {
		$result = $this->modele->getStats();
		$this->vue->loadPage($result);
	}
}

?>
