<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use User\User;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());

$orgarepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());


$idproject =  !empty($_GET['idproject']) ? $_GET['idproject'] : null;


if ($idproject) {

    $usersofproject = $userrepository->fetchByProject($idproject);
    foreach ($usersofproject as $userofproject){
        /** @var User $user */
        $user = ((Object)$userofproject)->user;
        $projectrepository->deleteUser($user->getId(),$idproject);
    }
    $projectrepository->delete($idproject);
}

echo json_encode($viewData);

