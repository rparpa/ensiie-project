<?php
require_once '../../vendor/autoload.php';

use auth\JWT;
use Db\Connection;
use Db\ItemManager;
use Db\TokenManager;
use models\Category;
use models\Item;
use models\User;

if (isset($_POST["item-name"])
    && isset($_POST["description"])
    && isset($_POST["categories-selected"])
    && isset($_FILES['file'])
    && isset($_POST["token"])
    && (new TokenManager(Connection::get()))->findByToken($_POST['token']) != null) {
    $imagesLocation = '../images/items/';
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    if (in_array($extension, $extensions)) {
        $uniqueName = uniqid('', true);
        $file = $uniqueName . "." . $extension;
        move_uploaded_file($tmpName, $imagesLocation . $file);
        $categories = [];
        $idCategories = substr($_POST["categories-selected"], 0, -1);
        if ($idCategories !== "") {
            foreach (explode("/", $idCategories) as $idCat) {
                $categories[] = new Category($idCat, "", 0);
            }
        }
        $jwt = new JWT();
        $item = new Item(0,
            $_POST["item-name"],
            new User($jwt->getPayload($_POST["token"])["email"], "", "", "", "", "", 1, "", "", false, false),
            $file,
            $_POST["description"],
            "",
            true,
            $categories);
        $itemManager = new ItemManager(Connection::get());
        $itemManager->create($item);
        header('Location: ../user-pages/mes-objets.php');
    } else {
        echo "Mauvaise extension";
        header('Location: ../user-pages/ajouter-objet.php');
    }
    die();
} else {
    header('Location: ../user-pages/ajouter-objet.php');
    die();
}

?>