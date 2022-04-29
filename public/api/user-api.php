<?php

use auth\JWT;
use Db\UserManager;
use Db\Connection;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-desous une liste de fonctions à utliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$userManager = new UserManager(Connection::get());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["email"])) {
        $userFromDBById = $userManager->findById($_GET["email"]);
        if ($userFromDBById === null) {
            echo json_encode(['UserIdNotFound' => "true", 'Message' => "L'utilisateur recherche n'est pas trouve"]);
        }
        echo json_encode($userFromDBById);
    } else {
        echo json_encode($userManager->findAll(), JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET["token"])) {
        $jwt = new JWT();
        $email = $jwt->getPayload($_GET["token"])['email'];
        $userManager->lockByEmail($email);
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}
