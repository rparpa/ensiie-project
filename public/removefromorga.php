<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$orgrepository =
    new OrganizationRepository(Connection::get(),new OrganizationHydrator());

//var_dump($_GET);
$iduser = !empty($_GET['iduser']) ? $_GET['iduser'] : null;
$idorganization = !empty($_GET['idorganization']) ? $_GET['idorganization'] : null;

if(null!==$iduser && null!==$idorganization){
    $orgrepository->removeUser(
        $iduser,
        $idorganization);
}
