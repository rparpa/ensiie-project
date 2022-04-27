<?php

use Db\Connection;
use Db\SwapManager;
use models\Swap;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
$swapJson = json_decode(file_get_contents('php://input'), true);
$swapToUpdate = new Swap($swapJson["id"], $swapJson["creation_date"], $swapJson["end_date"], $swapJson["is_done"], $swapJson["status"], $swapJson["user_from"], $swapJson["user_to"], $swapJson["items"]);
$swapUpdated = (new SwapManager(Connection::get()))->update($swapToUpdate);
echo json_encode($swapUpdated, JSON_UNESCAPED_UNICODE);