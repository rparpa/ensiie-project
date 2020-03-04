<?php

class VueStats extends VueGenerique {

    function __construct() {
        parent::__construct("stats");
    }
    
    function loadPage($tab) {
        $messages = $tab;
        include $this->contenu;
    }
}

?>
