<?php

class ModuleRegister extends ModuleGenerique {
    
	function __construct () {
        require_once 'controller_register.php';
        require_once 'view_register.php';
        require_once 'model_register.php';
        $this->controller = new ControllerRegister();
    }
}

?>
