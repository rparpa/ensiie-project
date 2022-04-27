<?php

use Db\Connection;
use Db\ItemManager;
use models\Item;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-dessous une liste de fonctions à utiliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$itemManager = new ItemManager(Connection::get());

// TODO : Ajouter endpoint pour récupérer les items swappables
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $itemFromDBById = $itemManager->findById($_GET["id"]);
        if ($itemFromDBById === null) {
            echo json_encode(['ItemIdNotFound' => "true", "Message" => "Objet non trouve"]);
        } else echo json_encode($itemFromDBById);
    } else {
        $itemsFromDB = $itemManager->findAll();
        if ($itemsFromDB === []) {
            echo json_encode(['ItemsNotFound' => "true", "Message" => "Aucun objet trouve"]);
        } else echo json_encode($itemsFromDB);
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $itemManager->create(new Item(-1, $_POST['name'], $_POST["proprietary"], $_POST["picture"], $_POST["description"], "05/01/2002", false, []));
    echo json_encode($item);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET["id"])) {
        $itemManager->deleteById($_GET["id"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}


