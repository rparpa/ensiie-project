<?php

use \Db\Connection;
use \Model\Section;
use \Model\Article;

$pdo = Connection::get();
$newSection = $_POST['section'];

$section = new Section(
    $pdo, 0, $newSection['articleID'],
    $newSection['title'], $newSection['content']
);
$section->insertDatabase();

$article = new Article($pdo);
$article->setId($newSection['articleID']);
$article->updateArticleDate();

echo json_encode(array('status' => 'success'));
?>