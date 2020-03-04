<?php

class ModuleReset extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_reset.php';
        require_once 'view_reset.php';
        require_once 'model_reset.php';
        $this->controller = new ControllerReset();
    }
}

?>
