<?php
use \Model\NewCategory;
use \Db\Connection;

$pdo = Connection::get();
$result = NewCategory::getAll($pdo);

echo json_encode(array('status' => "success", 'categories' => $result));
?>