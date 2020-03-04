<?php

//
// Handler de la page de chat
//

require_once "include/view_gen.php"; 
require_once "include/controller_gen.php"; 
require_once "include/model_gen.php"; 
require_once "include/module_gen.php";

//Si JSON
if (isset($_POST["data"])) {
    $data = json_decode($_POST["data"]);
    session_start();
    $module = $data->module;

    switch ($module) {
        case 'chat':
            require_once 'modules/module_' . $module . '/module_' . $module . '.php';

            $mod = new ModuleChat();

            break;

        case 'cookie':
            $cookie_name = $data->name;
            $cookie_value = $data->value;
            setcookie($cookie_name, $cookie_value, time() + (30));

            break;

        default:

            break;
    }
//Sinon, dépot de fichier
} else if (isset($_FILES['file'])) {
    require_once 'modules/module_chat/module_chat.php';
    $module = new ModuleChat();
}

?>
