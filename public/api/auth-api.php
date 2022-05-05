<?php

use auth\JWT;
use Db\Connection;
use Db\TokenManager;
use Db\UserManager;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

$userToken = null;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['token'])) {
        $token = (new TokenManager(Connection::get()))->findByToken($_GET['token']);
        if ($token != null) {
            $jwt = new JWT();
            $userToken = (new UserManager(Connection::get()))->findById($token->getUserMail());
            echo json_encode($userToken);
        } else {
            echo json_encode(['TokenNotFound' => 'Le token n\'a pas ete trouve']);
        }
    } else {
        echo json_encode(['MissingParam' => 'Il manque un token en parametre']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}