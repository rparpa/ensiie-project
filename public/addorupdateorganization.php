<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

//if(!isset($_SESSION["user_id"]))
//    header('Location: index.php');

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$ograrepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$id =  !empty($_GET['id']) ? $_GET['id'] : null;
$name =  !empty($_GET['name']) ? $_GET['name'] : null;


$viewData = [];


function checkFormData(OrganizationRepository $organizationRepository, $id, $name)
{
    $errorMessage = [];
    if(null==$name) {
        $errorMessage['nameEmpty'] = "The name can't be empty";
        return $errorMessage;
    }
    if($id) {
        $orga = $organizationRepository->findOneByName($name);
        if($orga){
            if($id!=$orga->getId()){
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
}

echo json_encode($viewData);

