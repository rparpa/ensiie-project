<?php

use auth\JWT;
use Db\Connection;
use Db\NotificationManager;
use Db\TokenManager;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-desous une liste de fonctions à utliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$notificationManager = new NotificationManager(Connection::get());
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode((new NotificationManager(Connection::get()))->findAllByUserMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]),
        JSON_UNESCAPED_UNICODE);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET["mail"]) && $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"] == $_GET["mail"]) {
        echo json_encode((new NotificationManager(Connection::get()))->deleteAllByMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]),
            JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}