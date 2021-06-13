<?php

use \Db\Connection;
use \Model\Section;
file_put_contents('php://stderr', print_r($_POST, TRUE));
$pdo = Connection::get();
$newSection = $_POST['section'];
file_put_contents('php://stderr', print_r($newSection, TRUE));

$section = new Section(
    $pdo, $newSection['sectionID'], $newSection['articleID'],
    $newSection['title'], $newSection['content']
);
$section->updateSection();
?>