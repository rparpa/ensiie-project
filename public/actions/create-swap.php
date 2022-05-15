<?php
require_once '../../vendor/autoload.php';

use auth\JWT;
use Db\Connection;
use Db\ItemManager;
use Db\SwapManager;
use Db\TokenManager;
use Db\UserManager;
use models\Category;
use models\Item;
use models\Swap;

if (isset($_POST["items-selected"]) && isset($_POST["token"])
    && (new TokenManager(Connection::get()))->findByToken($_POST['token']) != null) {
    $idItems = explode('/', $_POST["items-selected"]);
    if (sizeof($idItems) < 2) {
        header('Location: ../user-pages/recherche.php');
        die();
    }
    $idItemWanted = $idItems[sizeof($idItems) - 1];

    $items = [];
    $itemManager = new ItemManager(Connection::get());
    $swapManager = new SwapManager(Connection::get());
    $userManager = new UserManager(Connection::get());
    foreach ($idItems as $idItem) {
        $items[] = $itemManager->findById($idItem);
    }
    $jwt = new JWT();
    // On vérifie que tous les objets sont des objets de notre utilisateur
  /*  for ($i = 0; $i < count($items) - 1; $i++) {
        if ($items[$i]->getProprietary()->getMail() != $jwt->getPayload($_POST["token"])["email"]) {
            header('Location: ../user-pages/recherche.php');
            die();
        }
    } */

    $swap = new Swap(0, "", "", false, 0, $userManager->findById($jwt->getPayload($_POST["token"])["email"]), $itemManager->findById($idItemWanted)->getProprietary(), $items);
    $swapManager->create($swap);
    header('Location: ../user-pages/mes-trocs.php');
    die();


} else {
    header('Location: ../user-pages/recherche.php');
    die();
}

?>