<?php

class VueCreate extends VueGenerique {

    function __construct() {
        parent::__construct("create");
    }

    function loadPage($message, $key) {
        $error = parent::getErrorDiv($message);
        include $this->contenu;
    }
}

?>
