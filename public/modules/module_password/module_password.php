<?php

class ModulePassword extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_password.php';
        require_once 'view_password.php';
        require_once 'model_password.php';
        $this->controller = new ControllerPassword();
    }
}

?>
