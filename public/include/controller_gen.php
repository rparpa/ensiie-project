<?php

class ControleurGenerique  {

	public $vue; 
	public $modele; 

	function __construct($d,$u,$p) {
		$this->vue = new VueGenerique() ; 
		$this->modele = new ModeleGenerique($d,$u,$p) ;
	}

	function getVue() {
		return $this->vue; 
	}
}

?>
