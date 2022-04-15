<?php
require_once '../../vendor/autoload.php';
use Db\Connection;
use Db\ItemManager;
use models\Item;

if (isset($_POST["item-name"])
    && isset($_POST["description"])
    && isset($_POST["categories-selected"])
    && isset($_FILES['file'])) {
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
        $item = new Item(0, $_POST["item-name"], "toto", $file, $_POST["description"], "", true);
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