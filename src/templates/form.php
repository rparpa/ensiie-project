<?php


use Db\Connection;
use Db\ItemManager;
use models\Item;

echo'
<form method="GET" action="">
     <p>Votre prop : <input type="text" name="prop" /></p>
     <p>Votre pic : <input type="text" name="pic" /></p>
     <p>Votre des : <input type="text" name="des" /></p>
     <p>Votre date : <input type="text" name="date" /></p>
     <p>Votre swap : <input type="text" name="swap" /></p>
     <p><input type="submit" name="ok" value="OK"></p>  
</form>';

if(isset($_GET['prop'])){

    echo 'je rentre';
    $itemManager = new ItemManager(Connection::get());
    $item = array();

    $item12 = $itemManager->select(12);

    $item = $itemManager->selectAll();



    echo("<br/>");
    print_r($item12);

    echo("<br/>");

    echo("<br/>");


    print_r($item);




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
}

?>