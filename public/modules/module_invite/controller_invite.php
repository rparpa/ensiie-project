<?php

class ControllerInvite extends ControleurGenerique {

    function __construct() {
        require_once 'params_co.php';
        $this->modele = new ModeleInvite($dsn, $user, $password);
        $this->vue = new VueInvite();
        $this->action();
    }

    function action() {
        $message = NULL;

        if (isset($_GET['submit']) && $_GET['submit'] == 'on') { //Si submit
            $message = $this->modele->sendEmail();

            if ($message == NULL) //Si il n'y pas eu de problèmes
                header('Location: index.php?module=module_chat&key=' . $_COOKIE['conversationID']);
        }

        $this->vue->loadPage($message);
    }
}

?>
