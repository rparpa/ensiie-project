<?php

require_once '../src/Bootstrap.php';
date_default_timezone_set('UTC');

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET"){
    include '../src/'.$_GET['request'];
}
elseif( $method == "POST"){
    include '../src/'.$_POST['request'];
}
?>