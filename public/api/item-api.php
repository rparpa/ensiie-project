<?php

use Db\ItemManager;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-dessous une liste de fonctions à utiliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$itemManager = new ItemManager(\Db\Connection::get());


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $itemFromDBById = $itemManager->select($_GET["id"]);
        if ($itemFromDBById === null) {
            echo json_encode(['ItemIdNotFound' => "true", "Message" => "Objet non trouve"]);
        } else echo json_encode($itemFromDBById);

    } else {
        echo json_encode($itemManager->selectAll());
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $itemManager->insert($_POST[]);
    echo json_encode($item);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}


