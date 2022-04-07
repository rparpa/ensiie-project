<?php

require_once "../../src/models/Item.php";
require_once "../../src/Db/ItemManager.php";


use Db\Connection;
use models\Item;
use Db\ItemManager;


$item = new Item(1,$_POST['prop'],$_POST['pic'],$_POST['des'],$_POST['date'],$_POST['swap']);

$itemManager = new ItemManager(Connection::get());

$saveisOk=$itemManager->save($item);

if($saveisOk){
    echo('ok');
}
else{
    echo('pas ok');
}





