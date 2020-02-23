<?php

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$data = $_GET;


loadView('project',$data);