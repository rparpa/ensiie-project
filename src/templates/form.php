<?php


use Db\Connection;
use Db\ItemManager;
use models\Item;

echo'
<form method="GET" action="">
     <p>Recherche obj : <input type="text" name="prop" /></p>  
</form>';

if(isset($_GET['prop'])) {


    $item = new Item(1, 'sam', 'sam@hotmail.fr', 'photo.png', 'salslalsallasa', '08-10-21', true);

    $itemManager = new ItemManager(Connection::get());

    $item2 = $itemManager->rechercheItemCat($_GET['prop'],"2 6 7");

    print_r($item2);
}


    //$saveisOk=$itemManager->insert($item);

    //$item2=$itemManager->getItemByProprietary('test');
    //print_r($item2);



    /*

    $itemManager = new ItemManager(Connection::get());

    $item= $itemManager->select(12);


    echo($item->getPicture());


    $item = array();

    $item12 = $itemManager->select(12);

    echo($item12->getPicture());


    $item = $itemManager->selectAll();

    echo("<br/>");
    print_r($item12);

    echo("<br/>");

    echo("<br/>");

    echo("----------------------------------------------------------------------------------------");

    $items = $itemManager->selectAll();



    print_r($items);
    */


    /*
    $item->setProprietary('samy_750@hotmail.fr');
    $item->setPicture('photo.png');
    $item->setDescription('salslalsallasa');
    $item->setCreationDate('08-10-21');
    $item->setIsSwappable('true');
    */

    #$saveisOk=$itemManager->insert($item);

    /*
    echo($item->getCreationDate());
    echo($item->getIsSwappable());
    echo($item->getPicture());

    */


?>