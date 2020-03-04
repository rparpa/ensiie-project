<?php

class ModuleConversations extends ModuleGenerique {
		
    function __construct () {
        require_once 'controller_conversations.php';
        require_once 'view_conversations.php';
        require_once 'model_conversations.php';
        $this->controller = new ControllerConversations();
    }
}

?>
