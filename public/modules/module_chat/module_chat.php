<?php

class ModuleChat extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_chat.php';
        require_once 'view_chat.php';
        require_once 'model_chat.php';
        $this->controller = new ControllerChat();
    }
}

?>
