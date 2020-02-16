<?php
include_once '../src/utils/autoloader.php';
session_destroy();

header('Location: index.php'); 

?>