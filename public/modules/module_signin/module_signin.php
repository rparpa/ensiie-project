<?php

class ModuleSignin extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_signin.php';
        require_once 'view_signin.php';
        require_once 'model_signin.php';
        $this->controller = new ControllerSignin();
    }
}

?>
