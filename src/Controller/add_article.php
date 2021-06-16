<?php
use Model\Article;
use Db\Connection;
  
$article = $_POST['article'];
$pdo = Connection::get();
$art = Article::fromDict($pdo, $article);
$art->createArticle();

echo json_encode(array('status' => "success", 'articleID' => $art->getId()));
?>