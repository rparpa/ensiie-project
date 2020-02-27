<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());

$orgarepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$name =  !empty($_GET['name']) ? $_GET['name'] : null;
$idorganization =  !empty($_GET['idorganization']) ? $_GET['idorganization'] : null;


$viewData = [];

function checkFormData(ProjectRepository $projectrepository, $name, $idorganization)
{
    $errorMessage = [];
    if(null==$name) {
        $errorMessage['nameEmpty'] = "The name can't be empty";
    }
    if(null==$idorganization)
    {
        $errorMessage['nameproject'] = "The organization can't be empty";
    }
    $proj = $projectrepository->findOneByName($name);
    if(null!=$proj){
        $errorMessage['existproject'] = "The project name exist";
    }
    return $errorMessage;
}



$viewData = checkFormData($projectrepository, $name, $idorganization);

if (empty($viewData)) {

    $orga = $orgarepository->findOneById($idorganization);
    {
        $projectrepository->insert($name, $orga, new DateTimeImmutable("now"));
    }
}

echo json_encode($viewData);

