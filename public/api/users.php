<?php

use auth\JWT;
use Db\TokenManager;
use Db\UserManager;
use Db\Connection;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-desous une liste de fonctions à utliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$userManager = new UserManager(Connection::get());
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["email"])) {
        $userFromDBById = $userManager->findById($_GET["email"]);
        if ($userFromDBById === null) {
            echo json_encode(['UserIdNotFound' => "true", 'Message' => "L'utilisateur recherche n'existe pas."]);
        }
        echo json_encode($userFromDBById);
    } else {
        echo json_encode($userManager->findAll(), JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lockEmailObject = json_decode(file_get_contents('php://input'), true);
    if (isset($lockEmailObject['lockEmail'])) {
        $userFromDBById = $userManager->findById($lockEmailObject['lockEmail']);
        if ($userFromDBById === null) {
            echo json_encode(['UserIdNotFound' => "true", 'Message' => "L'utilisateur recherche n'existe pas."]);
        } else if ($userFromDBById->getIsSuperUser()) {
            echo json_encode(['UserIsAdmin' => "true", 'Message' => "Cet utilisateur est un administrateur. Il ne peut pas être banni."]);
        } else {
            echo json_encode($userManager->lockByEmail($lockEmailObject['lockEmail']));
        }
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}
