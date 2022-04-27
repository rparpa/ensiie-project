<?php
use Db\Connection;
use Db\ItemManager;
use models\Item;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";

if (isset($_REQUEST['id'])) {
    (new ItemManager(Connection::get()))->deleteById($_REQUEST['id']);
}

