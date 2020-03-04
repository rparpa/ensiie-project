<?php

class VueJoin extends VueGenerique {

    function __construct() {
        parent::__construct("join");
    }

    function loadPage($message) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>