<?php


use Db\Connection;
use Db\ItemManager;
use models\Item;

echo'
<form method="GET" action="">
     <p>Recherche obj : <input type="text" name="prop" /></p>  
</form>';

if(isset($_GET['prop'])) {


    $itemManager = new ItemManager(Connection::get());
    $item2 = $itemManager->rechercheItemCat($_GET['prop'],"2 6 7");


    /*###################Générer fichier JSON####################################*/
    $items=array();
    foreach($item2 as $i){
        $tab=(array)$i;//conversion de nos objets item en tableau
        foreach($tab as $k => $val){
            $cle = substr($k, 12);//retrait de ce qui est en trop dans nos clés :  "item\model
            $tab[$cle] = $tab[$k];//remplacement des clés dans le tableau par les nouvelles
            unset($tab[$k]);//effacement des anciennes clés
        }
        $items[] = $tab;
    }
    $json = str_replace('\\u0000',"",json_encode($items));//retirer \\u0000
    $bytes = file_put_contents("json_file.json", $json);
    /*###################Générer fichier JSON####################################*/


}


    //$saveisOk=$itemManager->insert($item);

    //$item2=$itemManager->getItemByProprietary('test');
    //print_r($item2);


    //$item = new Item(1, 'sam', 'sam@hotmail.fr', 'photo.png', 'salslalsallasa', '08-10-21', true);


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