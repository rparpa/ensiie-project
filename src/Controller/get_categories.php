<?php
use \Model\Category;
use \Db\Connection;

$pdo = Connection::get();
$result = Category::getAll($pdo);
echo json_encode(array('status' => "success", 'categories' => $result));
?>