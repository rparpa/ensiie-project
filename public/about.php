<?php

$data = [
    'founder' => 'Ikea - Asur - Gat'
];
require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';
loadView('about', $data);
