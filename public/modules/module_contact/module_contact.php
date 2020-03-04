<?php

class ModuleContact extends ModuleGenerique {
    
    function __construct () {
        require_once 'controller_contact.php';
        require_once 'view_contact.php';
        require_once 'model_contact.php';
        $this->controller = new ControllerContact();
    }
}

?>
