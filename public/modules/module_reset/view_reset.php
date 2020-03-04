<?php

class VueReset extends VueGenerique {
    
    function __construct() {
        parent::__construct("reset");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>