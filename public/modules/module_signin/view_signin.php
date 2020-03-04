<?php

class VueSignin extends VueGenerique {

    function __construct() {
        parent::__construct("signin");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
