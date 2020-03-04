<?php

class VueForgot extends VueGenerique {
    
    function __construct() {
        parent::__construct("forgot");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>