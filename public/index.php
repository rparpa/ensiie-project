<?php

session_start();

//Include toutes les classes génériques, dès la racine car utilisé presque partout
require_once "include/view_gen.php"; 
require_once "include/controller_gen.php"; 
require_once "include/model_gen.php"; 
require_once "include/module_gen.php";

//Get le module, si vide le module devient "accueil"
$nom_module = isset($_GET['module']) ? $_GET['module'] : 'module_accueil';

//Si demande de déconnexion, vidé les variables de SESSION
if (isset($_GET['logout']) ) {
    $_SESSION = array();
}

//Liste des pages ne nécessitant pas d'être connecté
$pageSansBesoinDetreCo = array('module_accueil', 'module_register', 'module_forgot', 'module_contact', 'module_reset', 'module_privacy', 'module_about', 'module_stats', 'module_help');

//Check si pas connecté et redirection vers la page de connexion si la page demandé requiert de l'être
if (!isset($_SESSION['pseudo']) && !in_array($nom_module, $pageSansBesoinDetreCo))
    $nom_module = 'module_signin';

$needsPHPMailer = array('module_contact', 'module_forgot', 'module_invite');
if (in_array($nom_module, $needsPHPMailer)) {
    require_once 'PHPMailer/src/Exception.php';
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';
}

switch ($nom_module) {
    case 'module_accueil':
        if (isset($_COOKIE['conversationID']))
            setcookie('conversationID', "");

        require_once 'include/templates/welcome.html';
        
        break;

    case 'module_signin': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleSignin();
        break;

	case 'module_register': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleRegister();
        
        break;

    case 'module_conversations': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleConversations();
        
        break;

    case 'module_addadmin': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleAddadmin();
        
        break;

    case 'module_flag': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleFlag();
        
        break;

    case 'module_create': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleCreate();
        
        break;

    case 'module_invite':
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleInvite();
        
        break;

	case 'module_join':
		require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleJoin();

        break;

    case 'module_profile' : 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleProfile();

        break;

    case 'module_edit' : 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleEdit();

        break;

    case 'module_password':
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModulePassword();

        break;

    case 'module_forgot': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleForgot();
        
        break;

    case 'module_reset':
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleReset();
        
        break;

    case 'module_contact' :
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleContact();

        break;

    case 'module_chat': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleChat();

        break;

    case 'module_stats': 
        require_once "modules/" . $nom_module . "/" . $nom_module . ".php";
        $mod = new ModuleStats();

        break;
    
    case 'module_about': 
        require_once 'include/templates/about.html';

        break;

    case 'module_privacy': 
        require_once 'include/templates/privacy.html';

        break;

    case 'module_help': 
        require_once 'include/templates/help.html';

        break;

    default : 
        require_once 'include/templates/notfound.html';
        break;
}

?>
