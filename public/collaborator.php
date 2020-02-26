<?php

require_once '../src/Bootstrap.php';

if(!isset($_SESSION["user_id"]))
    header('Location: index.php');


include_once '../src/View/template.php';
loadView('collaborator', []);