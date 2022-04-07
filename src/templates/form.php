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

    $item = new Item(7,$_GET['prop'],$_GET['pic'],$_GET['des'],$_GET['date'],$_GET['swap']);

    $itemManager = new ItemManager(Connection::get());

    $saveisOk=$itemManager->save($item);

    if($saveisOk){
        echo('ok');
    }
    else{
        echo('pas ok');
    }
}

?>