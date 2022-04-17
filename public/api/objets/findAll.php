<?php

use Db\ItemManager;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
$items = (new ItemManager(Connection::get()))->findAllByProprietaryMail("toto");
header('Content-type: application/json');
echo json_encode($items);
?>
