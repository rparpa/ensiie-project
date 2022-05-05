<?php

use auth\JWT;
use Db\Connection;
use Db\CategoryManager;
use Db\TokenManager;
use models\Category;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

$categoryManager = new CategoryManager(Connection::get());
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

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
