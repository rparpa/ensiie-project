<?php


use Db\Connection;
use Db\ItemManager;
use models\Item;

echo'
<form action="" method="POST">
     <p>Votre prop : <input type="text" name="prop" /></p>
     <p>Votre pic : <input type="text" name="pic" /></p>
     <p>Votre des : <input type="text" name="des" /></p>
     <p>Votre date : <input type="text" name="date" /></p>
     <p>Votre swap : <input type="text" name="swap" /></p>
     <p><input type="submit" value="OK"></p>  
</form>';

if(isset($_POST)){

    $item = new Item(1,$_POST['prop'],$_POST['pic'],$_POST['des'],$_POST['date'],$_POST['swap']);

    $itemManager = new ItemManager(Connection::get());

    $saveisOk=$itemManager->save($item);

    if($saveisOk){
        echo('ok');
    }
    else{
        echo('pas ok');
    }
}