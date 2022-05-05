<?php

use Db\UserManager;
use Db\Connection;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-desous une liste de fonctions à utliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$userManager = new UserManager(Connection::get());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["email"])) {
        //var_dump($userManager->findById($_GET["email"]));
        $userFromDBById = $userManager->findById($_GET["email"]);
        if ($userFromDBById === null) {
            echo json_encode(['UserIdNotFound' => "true", 'Message' => "L'utilisateur recherche n'existe pas."]); // OK
        }
        echo json_encode($userFromDBById); // OK
    } else {
        echo json_encode($userManager->findAll(), JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lockEmailObject = json_decode(file_get_contents('php://input'), true);
    if(isset($lockEmailObject['lockEmail'])){
        $userFromDBById = $userManager->findById($lockEmailObject['lockEmail']);
        if($userFromDBById === null){
            echo json_encode(['UserIdNotFound' => "true", 'Message' => "L'utilisateur recherche n'existe pas."]);
        }
        else if($userFromDBById->getIsSuperUser()){
            echo json_encode(['UserIsAdmin' => "true", 'Message' => "Cet utilisateur est un administrateur. Il ne peut pas être banni."]);
        }
        else {
            echo json_encode($userManager->lockByEmail($lockEmailObject['lockEmail']), JSON_PRETTY_PRINT);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}
