<?php

use Db\Connection;
use Db\ItemManager;
use models\Item;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
$requestName = "";
$categories = array();
if (isset($_GET['name'])) {
    $requestName = $_GET['name'];
}
if (isset($_GET['categories'])) {
    $categories = explode('/', $_GET['categories']);
}

header('Content-type: application/json');
echo json_encode((new ItemManager(Connection::get()))->searchByNameAndCategoriesId($requestName, $categories), JSON_UNESCAPED_UNICODE);

