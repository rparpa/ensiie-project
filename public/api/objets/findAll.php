<?php

use Db\Connection;
use Db\ItemManager;
use models\Item;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
$item = new Item(1, "toto", "toto", "toto", "toto", "2022-05-11", true, [null]);
header('Content-type: application/json');
echo json_encode((new ItemManager(Connection::get()))->findAllByProprietaryMail("toto"), JSON_UNESCAPED_UNICODE);

