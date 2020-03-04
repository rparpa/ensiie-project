<?php

class VuePassword extends VueGenerique {
    
    function __construct() {
        parent::__construct("password");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>