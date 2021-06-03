<?php
use Db\Connection;
use Model\Article;

$pdo = Connection::get();
$exist = Article::exist($pdo, $_POST['title']);

if($exist) echo json_encode(array('status' => "success"));
else echo json_encode(array('status' => "failed"));
?>