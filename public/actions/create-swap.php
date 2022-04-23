<?php
require_once '../../vendor/autoload.php';

use Db\Connection;
use Db\ItemManager;
use Db\SwapManager;
use models\Category;
use models\Item;
use models\Swap;

if (isset($_POST["categories-selected"])) {
    $idItems = explode('/', $_POST["categories-selected"]);
    if (sizeof($idItems) < 2) {
        header('Location: ../user-pages/recherche.php');
        die();
    }
    $idItemWanted = $idItems[sizeof($idItems) - 1];

    $items = [];
    $itemManager = new ItemManager(Connection::get());
    $swapManager = new SwapManager(Connection::get());
    foreach ($idItems as $idItem) {
        $items[] = new Item($idItem, "", "", "", "", "", true, array());
    }
    $swap = new Swap(0, "", "", false, 0, "titi", $itemManager->findById($idItemWanted)->getProprietary(), $items);
    $swapManager->create($swap);
    header('Location: ../user-pages/mes-trocs.php');
    die();


} else {
    header('Location: ../user-pages/recherche.php');
    die();
}

?>