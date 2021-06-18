<?php

use \Db\Connection;
use \Model\Section;
use \Model\Article;

$pdo = Connection::get();
$newSection = $_POST['section'];

$section = new Section(
    $pdo, $newSection['sectionID'], $newSection['articleID'],
    $newSection['title'], $newSection['content']
);
$article = new Article($pdo);
$article->setId($newSection['articleID']);

$section->updateSection();
$article->updateArticleDate();

echo json_encode(array('status' => "success"));
?>