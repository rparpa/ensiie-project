<?php

use Db\Connection;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;

$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$authenticatorService = new AuthenticatorService($userRepository);
$user = $authenticatorService->getCurrentUser();

function loadView($view, $data) {
    session_start();
    ?>
    <html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php include_once '../src/View/layout/header.php' ?>
    <div class="main">
        <div class="main-container">
            <?php include_once '../src/View/'.$view.'.php' ?>
        </div>
        <div class="main-chat">
            <?php include_once '../src/View/chat.php' ?>
        </div>
    </div>
    <?php include_once '../src/View/layout/footer.php' ?>
    </body>
    </html>
<?php
}
?>