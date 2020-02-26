<?php

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

if(!isset($_SESSION["user_id"]))
    header('Location: index.php');

loadView('myprojects',[]);