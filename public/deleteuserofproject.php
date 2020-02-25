<?php

use Db\Connection;
use Project\ProjectHydrator;
use Project\ProjectRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());

$iduser =  !empty($_GET['iduser']) ? $_GET['iduser'] : null;
$idproject =  !empty($_GET['idproject']) ? $_GET['idproject'] : null;

//TODO Il reste a sécuriser et controler les données avant insertion

if (null!==$idproject && null!==$iduser){
    $projectrepository->deleteUser($iduser,$idproject);
}


