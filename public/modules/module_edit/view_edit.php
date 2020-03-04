<?php

class VueEdit extends VueGenerique {

	public $info; 

    function __construct() {
        parent::__construct("edit");
        $this->info = array();
    }

	function setInfo($result) {
		$this->info = $result ; 
	}

    function displayInfo($field) {
        echo $this->info[$field]; 
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
