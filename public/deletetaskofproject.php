<?php

use Db\Connection;
use Task\TaskHydrator;
use Task\TaskRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$taskrepository =
    new TaskRepository(Connection::get(),new TaskHydrator());

$idtask =  !empty($_GET['idtask']) ? $_GET['idtask'] : null;

//TODO Il reste a sécuriser et controler les données avant insertion

if (null!==$idtask){
    $taskrepository->delete($idtask);
}


