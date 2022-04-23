<?php

use Db\Connection;
use Db\ItemManager;


include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
header('Content-type: application/json');
echo json_encode((new ItemManager(Connection::get()))->findAllByProprietaryMail("titi"), JSON_UNESCAPED_UNICODE);

