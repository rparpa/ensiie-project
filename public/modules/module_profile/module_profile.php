<?php

class ModuleProfile extends ModuleGenerique {
    
	function __construct () {
        require_once 'controller_profile.php';
        require_once 'view_profile.php';
        require_once 'model_profile.php';
        $this->controller = new ControllerProfile();
    }
}

?>
