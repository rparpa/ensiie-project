<?php

class ModuleFlag extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_flag.php';
        require_once 'view_flag.php';
        require_once 'model_flag.php';
        $this->controller = new ControllerFlag();
    }
}

?>
