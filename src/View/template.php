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
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script
                src="https://code.jquery.com/jquery-3.4.1.js"
                integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
                crossorigin="anonymous"></script>
        <script
                src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                crossorigin="anonymous"></script>
        
    </head>
    <body>
    <?php include_once '../src/View/layout/header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">*
            <?php include_once '../src/View/chat.php' ?>
                
            </div>
            <div class="col-md-6">
            <?php include_once '../src/View/'.$view.'.php' ?>
            </div>
            <div class="col-md-3">
            <?php include_once '../src/View/info.php' ?>
            </div>
        </div>
    </div>


    <div class="main">
    <?php if ($authenticatorService->isAuthenticated()) {?>
        <div class="main-info col-md-offset-3 ">
            <?php include_once '../src/View/info.php' ?>
        </div>

        <div class="main-container col-md-offset-6">
            <?php include_once '../src/View/'.$view.'.php' ?>
        </div>
        
        <div class="main-chat col-md-offset-3 " >
            <?php include_once '../src/View/chat.php' ?>
        </div>
        

        <?php } else { ?>
            
        <div class="main-container col-md-12">
            <?php include_once '../src/View/'.$view.'.php' ?>
        </div>
        <?php } ?>
         
    </div>
        <?php include_once '../src/View/layout/footer.php' ?>
    </body>
    </html>
<?php
}
?>