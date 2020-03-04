<?php

class VueAddadmin extends VueGenerique {
    
    function __construct() {
        parent::__construct("addadmin");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
