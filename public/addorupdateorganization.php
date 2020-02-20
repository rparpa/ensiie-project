<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

if(!isset($_SESSION["user_id"]))
    header('Location: index.php');

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$orgahydrator =
    new OrganizationHydrator();
$ograrepository =
    new OrganizationRepository(Connection::get(), $orgahydrator);

$id =  !empty($_POST['id']) ? $_POST['id'] : null;
$name =  !empty($_POST['name']) ? $_POST['name'] : null;


$viewData = [];


function checkFormData(OrganizationRepository $organizationRepository, $id, $name)
{
    $errorMessage = [];
    if(null==$name) {
        $errorMessage['nameEmpty'] = "The name can't be empty";
        return $errorMessage;
    }
    if($id) {
        $organization = $organizationRepository->findOneById($id);
        $orga = $organizationRepository->findOneByName($name);
        if($orga){
            if($organization->getId()!==$orga->getId()){
                $errorMessage['nameAlreadyExist'] = "The name you tried to update already exists";
            }
        }

    }
    else{
        if(null!=$organizationRepository->findOneByName($name)) {
            $errorMessage['nameAlreadyExist'] = "The organization you tried to register already exists";
        }
    }
    return $errorMessage;
}


$id =  !empty($_POST['id']) ? $_POST['id'] : null;
$name =  !empty($_POST['name']) ? $_POST['name'] : null;

$viewData = checkFormData($ograrepository, $id, $name);
if (empty($viewData)) {

        if ($id) {
            $orga = $ograrepository->findOneById($id);
            if ($orga) {
                $ograrepository->update($id, $name);
            }
        } else {
            $ograrepository->insert($name, new DateTimeImmutable("now"));
        }
        header("location:" . $_SERVER['HTTP_REFERER']);
}
loadView('organization', $viewData);

