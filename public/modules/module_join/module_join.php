<?php

class ModuleJoin extends ModuleGenerique {

    function __construct () {
        require_once 'controller_join.php';
        require_once 'view_join.php';
        require_once 'model_join.php';
        $this->controller = new ControllerJoin();
    }
}

?>
