<?php

use Db\Connection;
use Db\CategoryManager;
use models\Category;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

$categoryManager = new CategoryManager(Connection::get());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["email"])) {
        $categoryById = $categoryManager->findById($_GET["id"]);
        if ($categoryById === null) {
            echo json_encode(['CategoryIdNotFound' => "true", 'Message' => "La categorie recherche n'est pas trouvee"]);
        }
        echo json_encode($categoryById);
    } else {
        echo json_encode($categoryManager->findAll(), JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newCategoryJson = json_decode(file_get_contents('php://input'), true);
    if (isset($newCategoryJson["categoryName"])) {
        echo json_encode($categoryManager->create(new Category(0, $newCategoryJson["categoryName"], 0)));
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
    exit;
}
