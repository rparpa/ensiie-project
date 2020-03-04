<?php

class VueRegister extends VueGenerique {

    function __construct() {
        parent::__construct("register");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>