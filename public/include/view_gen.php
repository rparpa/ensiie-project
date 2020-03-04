<?php 

class VueGenerique {

	public $contenu; 
	public $titre; 

	function __construct($page) {
		$this->contenu = 'include/templates/' . $page . '.html';
        $this->titre = ""; 
		ob_start(); 
	}

	function tamponVersContenu() {
		$this->contenu = ob_get_clean(); 
	}

	function setTitre($nom) {
		$this->titre = $nom ; 
	}

	function getTitre() {
		return $this->titre ;
	}

	function getErrorDiv($message) {
        if ($message != NULL) 
            return "<p><div id='error' class='alert alert-danger'>" . $message . "</div></p>";
	}
}

?>
