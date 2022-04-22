<?php

use Db\Connection;
use Db\SwapManager;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
header('Content-type: application/json');
$swapManager = new SwapManager(Connection::get());
$result = null;
if (isset($_GET["mail"]) && isset($_GET["is_done"])) {
    $result = $swapManager->findAllByIsDoneAndUserMail($_GET["mail"], $_GET["is_done"]);
} else {
    $result = $swapManager->findAll();
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

