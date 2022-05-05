<?php

use auth\JWT;
use Db\SwapManager;
use Db\Connection;
use Db\TokenManager;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-dessous une liste de fonctions à utiliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$swapManager = new SwapManager(Connection::get());
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $swapFromDBById = $swapManager->findById($_GET["id"]);
        if ($swapFromDBById === null) {
            echo json_encode(['SwapIdNotFound' => "true", "Message" => "Troc non trouve"]);
        } else echo json_encode($swapFromDBById);
    } else {
        if (isset($_GET["mail"]) && isset($_GET["is_done"]) && $_GET["mail"] == $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]) {
            $result = $swapManager->findAllByIsDoneAndUserMail($_GET["mail"], $_GET["is_done"]);
        } else if (isset($_GET["last-10"])) {
            $result = $swapManager->findAllOrderByEndDateDescLimit10();
        } else {
            $result = $swapManager->findAll();
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $swapJson = json_decode(file_get_contents('php://input'), true);
    $swapToUpdate = new Swap($swapJson["id"],
        $swapJson["creation_date"],
        $swapJson["end_date"],
        $swapJson["is_done"],
        $swapJson["status"],
        new User($swapJson["user_from"]["email"],
            $swapJson["user_from"]["firstname"],
            $swapJson["user_from"]["lastname"],
            $swapJson["user_from"]["pseudo"],
            $swapJson["user_from"]["password"],
            $swapJson["user_from"]["picture"],
            $swapJson["user_from"]["zipcode"],
            $swapJson["user_from"]["street"],
            $swapJson["user_from"]["city"],
            $swapJson["user_from"]["is_super_user"],
            $swapJson["user_from"]["is_banned"]
        ),
        new User($swapJson["user_to"]["email"],
            $swapJson["user_to"]["firstname"],
            $swapJson["user_to"]["lastname"],
            $swapJson["user_to"]["pseudo"],
            $swapJson["user_to"]["password"],
            $swapJson["user_to"]["picture"],
            $swapJson["user_to"]["zipcode"],
            $swapJson["user_to"]["street"],
            $swapJson["user_to"]["city"],
            $swapJson["user_to"]["is_super_user"],
            $swapJson["user_to"]["is_banned"]
        ),
        $swapJson["items"]);
    if ($swapToUpdate->getUserTo()->getMail() != $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]) {
        header('HTTP/1.0 401 Unauthorized');
        die();
    }
    $swapUpdated = (new SwapManager(Connection::get()))->update($swapToUpdate);
    echo json_encode($swapUpdated, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}