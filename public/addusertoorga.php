<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

var_dump($_GET);

$organizationrepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$iduser =  !empty($_GET['iduser']) ? $_GET['iduser'] : null;
$role =  !empty($_GET['role']) ? $_GET['role'] : null;
$idorga =  !empty($_GET['idorganization']) ? $_GET['idorganization'] : null;

//TODO Il reste a sécuriser et controler les données avant insertion

if (null!==$idorga && null!==$role && null!==$iduser){
    var_dump($role);
    $organizationrepository->addUser($iduser,$idorga,$role);
}

