<?php

class VueInvite extends VueGenerique {
    
    function __construct() {
        parent::__construct("invite");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
