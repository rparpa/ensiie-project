<?php

use Db\SwapManager;
use Db\Connection;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Ci-dessous une liste de fonctions à utiliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.

$swapmanager = new SwapManager(Connection::get());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $swapFromDBById = $swapmanager->findById($_GET["id"]);
        if ($swapFromDBById === null) {
            echo json_encode(['SwapIdNotFound' => "true", "Message" => "Troc non trouve"]);
        } else echo json_encode($swapFromDBById);

    } else {
        $swapFromDBById = $swapmanager->findAll();
        if ($swapFromDBById === null) {
            echo json_encode(['SwapsNotFound' => "true", "Message" => "Aucun troc trouve"]);
        } else echo json_encode($swapFromDBById);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}