<?php

use \Db\Connection;
use \Model\Article;


$pdo = Connection::get();
$newArticle = $_POST['article'];

$article = new Article($pdo);
$article->setId($newArticle['articleID'])
        ->setSynopsis($newArticle['synopsis'])
        ->updateArticle();

echo json_encode(array('status' => "success"));
?>