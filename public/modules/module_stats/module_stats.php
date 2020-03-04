<?php

class ModuleStats extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_stats.php';
        require_once 'view_stats.php';
        require_once 'model_stats.php';
        $this->controller = new ControllerStats();
    }
}

?>
