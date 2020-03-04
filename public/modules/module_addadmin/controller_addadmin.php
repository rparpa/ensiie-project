<?php

class ControllerAddadmin extends ControleurGenerique {
    
    function __construct() {
        require_once 'params_co.php';
        $this->modele = new ModeleAddadmin($dsn, $user, $password); 
        $this->vue = new VueAddadmin(); 
        $this->action();
    }

    function action() {
        $message = NULL;

        if (isset($_POST["pseudo"])) { //si submit
            $message = $this->modele->registerAdmin();
            
            if ($message == NULL) //Si l'utilisateur est bien été ajouté à la liste des administrateurs
                header('Location: index.php');
        }

        $this->vue->loadPage($message);
    }
}

?>
