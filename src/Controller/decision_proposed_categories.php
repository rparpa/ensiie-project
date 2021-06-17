<?php

use \Db\Connection;
use \Model\NewCategory;
use \Model\Category;


$pdo = Connection::get();
$name = $_POST['name'];
$keep = $_POST['keep'];


if($keep){
    $category = new Category($pdo, $name);
    $category->insertDatabase();
}
$category = new NewCategory($pdo, $name);
$category->deleteDatabase();

echo json_encode(array('status' => 'success'));
?>