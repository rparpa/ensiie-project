<?php

class ModuleAddadmin extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_addadmin.php';
        require_once 'view_addadmin.php';
        require_once 'model_addadmin.php';
        $this->controller = new ControllerAddadmin();
    }
}

?>
