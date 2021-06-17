<?php

use \Db\Connection;
use \Model\NewCategory;

$pdo = Connection::get();

$name = $_POST['name'];

$category = new NewCategory($pdo, $name);
$category->insertDatabase();

echo json_encode(array('status' => 'success'));
?>