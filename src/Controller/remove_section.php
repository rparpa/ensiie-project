<?php

use \Db\Connection;
use \Model\Section;
use \Model\Article;

$pdo = Connection::get();

$section = new Section($pdo, $_POST['sectionID'], $_POST['articleID'], "", "");
$section->removeSection();

echo json_encode(array('status' => "success"));
?>