<?php

class ModuleCreate extends ModuleGenerique {

    function __construct () {
        require_once 'controller_create.php';
        require_once 'view_create.php';
        require_once 'model_create.php';
        $this->controller = new ControllerCreate();
    }
}

?>
