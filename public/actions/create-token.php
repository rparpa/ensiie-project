<?php
require_once '../../vendor/autoload.php';

use Db\Connection;
use Db\TokenManager;
use models\Token;
include_once '../../src/auth/generate.php';

if (isset($_GET["email"])) {
    $tokenManager = new TokenManager(Connection::get());
    $result = $tokenManager->create(new Token(generateUserInfosArraysJWT($_GET["email"]), $_GET["email"]));
    if ($result != null) {
        echo '<script type="text/javascript">';
        echo 'localStorage.setItem("token","' . $result->getToken() . '");';
        echo 'document.location.href="../user-pages/accueil.php";';
        echo '</script>';
    }
}
