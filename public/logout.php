<?php
require_once '../src/Bootstrap.php';
session_start();
session_destroy();

header('Location: index.php'); 

