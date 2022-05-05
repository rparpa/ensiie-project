<?php

use auth\JWT;
use Db\Connection;
use Db\ItemManager;
use Db\TokenManager;
use models\Item;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-dessous une liste de fonctions à utiliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$itemManager = new ItemManager(Connection::get());
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

// TODO : Ajouter endpoint pour récupérer les items swappables
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $itemFromDBById = $itemManager->findById($_GET["id"]);
        if ($itemFromDBById === null) {
            echo json_encode(['ItemIdNotFound' => "true", "Message" => "Objet non trouve"]);
        } else echo json_encode($itemFromDBById);
    } else {
        if (isset($_GET['search'])) {
            $requestName = "";
            $categories = array();

            if (isset($_GET['name'])) {
                $requestName = $_GET['name'];
            }
            if (isset($_GET['categories'])) {
                $categories = explode('/', $_GET['categories']);
            }
            echo json_encode($itemManager->searchByNameAndCategoriesId($requestName, $categories), JSON_UNESCAPED_UNICODE);
        } else {
            $itemsOfUserFromDB = $itemManager->findAllByProprietaryMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]);
            echo json_encode($itemsOfUserFromDB, JSON_PRETTY_PRINT);
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $itemManager->create(new Item(-1, $_POST['name'], $_POST["proprietary"], $_POST["picture"], $_POST["description"], "05/01/2002", false, []));
    echo json_encode($item);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id'])) {
        echo json_encode($itemManager->deleteById($_GET['id']), JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}


