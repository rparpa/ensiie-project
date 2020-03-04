<?php

class ControllerConversations extends ControleurGenerique {
    
	function __construct () {
		require_once 'params_co.php';
		$this->modele = new ModeleConversations($dsn, $user, $password);
		$this->vue = new VueConversations();
		$this->action();
	}

    function action() {
        $this->vue->loadPage($this->modele->getConversations());
    }
}

?>