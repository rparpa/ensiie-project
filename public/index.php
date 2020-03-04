<?php

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use Ingredient\IngredientRepository;
use Ingredient\IngredientService;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;
use User\UserRepository;
use Invoice\InvoiceRepository;
use User\User;
use User\UserService;



require_once '../src/Bootstrap.php';


$my_connection = \Db\Connection::get();

$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);

$is_connected = isset($_COOKIE['id']) &&  $_COOKIE['id'] != null;

?>

<?php require_once '../src/User/UserRepository.php'; ?>

<!DOCTYPE HTML>

<html>
<head>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./index.js"></script>
    <title>SandwicherIIE</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
    <div id="wrapper">

        <header id="header">
            <div class="logo">
                <img src="images/logo.png" width="80%"></img>
            </div>
            <div class="content">
                <div class="inner">
                    <h1>La SandwicherIIE</h1>
                    <p>L'association Sandwich de l'ENSIIE, commandez votre menu avec nous</p>
                </div>
            </div>
            <nav>
                <ul>
                    <?
                    if(!$is_connected){
                        echo "<li><a href=\"connexion.php\">Connexion</a></li>";
                    } else {
                        echo "
                    <li><a href=\"order.php\">Commander</a></li>
                    <li><a href=\"contact.php\">Contact</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </header>


        <?php include 'footer.php';?>

    </div>

    <SCRIPT TYPE="text/javascript">


    verify = new verifynotify();
    verify.field1 = document.CreateAccount.newmdp;
    verify.field2 = document.CreateAccount.newmdp2;
    verify.result_id = "password_result";
    verify.match_html = "Passwords match.";
    verify.nomatch_html = "Please make sure your passwords match.";

    // Update the result message
    verify.check();

    //
    </SCRIPT>

	</body>
</html>
