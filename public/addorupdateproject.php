<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projecthydrator =
    new ProjectHydrator();
$projectrepository =
    new ProjectRepository(Connection::get(), $projecthydrator);

$orgahydrator =
    new OrganizationHydrator();
$orgarepository =
    new OrganizationRepository(Connection::get(), $orgahydrator);

$id =  !empty($_POST['id']) ? $_POST['id'] : null;
$name =  !empty($_POST['name']) ? $_POST['name'] : null;
$idorganization =  !empty($_POST['idorganization']) ? $_POST['idorganization'] : null;


$viewData = [];


function checkFormData(ProjectRepository $projectRepository, $id, $name, $idorganization)
{
    $errorMessage = [];
    if(null==$name) {
        $errorMessage['nameEmpty'] = "The name can't be empty";
        return $errorMessage;
    }
    if($id) {
        $project = $projectRepository->findOneById($id);
        $proj = $projectRepository->findOneByName($name);
        if($proj){
            if($project->getId()!==$proj->getId()){
                $errorMessage['nameAlreadyExist'] = "The name you tried to update already exists";
            }
        }
    }
    else{
        if(null!=$projectRepository->findOneByName($name)) {
            $errorMessage['nameAlreadyExist'] = "The organization you tried to register already exists";
        }
    }
    return $errorMessage;
}



$viewData = checkFormData($projectrepository, $id, $name, $idorganization);
if (empty($viewData)) {

    $orga = $orgarepository->findOneById($idorganization);
    if ($id) {
        $project = $projectrepository->findOneById($id);
        if ($project) {
            $projectrepository->update($id, $name, $orga);
        }
    } else {
        $projectrepository->insert($name, $orga, new DateTimeImmutable("now"));
    }
    header("location:" . $_SERVER['HTTP_REFERER']);
}
loadView('project', $viewData);

