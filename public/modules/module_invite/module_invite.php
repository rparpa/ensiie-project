<?php

class ModuleInvite extends ModuleGenerique {

    function __construct () {
        require_once 'controller_invite.php';
        require_once 'view_invite.php';
        require_once 'model_invite.php';
        $this->controller = new ControllerInvite();
    }
}

?>
