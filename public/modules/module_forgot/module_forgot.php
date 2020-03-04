<?php

class ModuleForgot extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_forgot.php';
        require_once 'view_forgot.php';
        require_once 'model_forgot.php';
        $this->controller = new ControllerForgot();
    }
}

?>
