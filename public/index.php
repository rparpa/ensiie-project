<?php

require_once '../src/Bootstrap.php';
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h3><?php echo 'Insérer Header' ?></h3>
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listUsers') {
            $userController = new \User\UserController(\Db\Connection::get());
            $users = $userController->listUsers();
        } else if ($_GET['action'] == 'connect') {
            $connexionController = new \User\UserController(\Db\Connection::get());
            if(isset($_POST["email"])) {
                $connexionController->identification($_POST);
            } else {
                $connexionController->afficheFormulaireConnexion();
            }
        } else if ($_GET['action'] == 'register') {
            $registerController = new \User\UserController(\Db\Connection::get());
            if(isset($_POST["email"])) {
                $registerController->enregistrement($_POST);
            } else {
                $registerController->afficheFormulaireInscription();
            }
        }
    } else {
        $userController = new \User\UserController(\Db\Connection::get());
        $users = $userController->listUsers();
    }
    ?>
</div>
</body>
</html>
