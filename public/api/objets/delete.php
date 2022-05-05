<?php
use Db\Connection;
use Db\ItemManager;


include "../../../vendor/autoload.php";

if (isset($_REQUEST['id'])) {
    (new ItemManager(Connection::get()))->deleteById($_REQUEST['id']);
}

