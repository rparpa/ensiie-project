<?php

use auth\JWT;
use Db\Connection;
use Db\TokenManager;
use Db\UserManager;

include "../../../vendor/autoload.php";

$userToken = null;
header('Content-type: application/json');
if (isset($_GET['token'])) {
    $token = (new TokenManager(Connection::get()))->findByToken($_GET['token']);
    if ($token != null) {
        $jwt = new JWT();
        $userToken = (new UserManager(Connection::get()))->findById($token->getUserMail());
    }
}
echo json_encode($userToken);