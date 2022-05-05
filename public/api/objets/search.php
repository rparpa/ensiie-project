<?php

use Db\Connection;
use Db\ItemManager;
use Db\TokenManager;
use models\Item;

include "../../../vendor/autoload.php";
$requestName = "";
$categories = array();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}
if (isset($_GET['name'])) {
    $requestName = $_GET['name'];
}
if (isset($_GET['categories'])) {
    $categories = explode('/', $_GET['categories']);
}

header('Content-type: application/json');
echo json_encode((new ItemManager(Connection::get()))->searchByNameAndCategoriesId($requestName, $categories), JSON_UNESCAPED_UNICODE);

