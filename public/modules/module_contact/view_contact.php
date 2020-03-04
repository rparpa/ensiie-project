<?php

class VueContact extends VueGenerique {

    function __construct() {
        parent::__construct("contact");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
