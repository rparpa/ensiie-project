<?php

class ModuleEdit extends ModuleGenerique {

    function __construct () {
        require_once 'controller_edit.php';
        require_once 'view_edit.php';
        require_once 'model_edit.php';
        $this->controller = new ControllerEdit();
    }
}

?>
