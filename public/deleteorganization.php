<?php

use Db\Connection;
use Meeting\Meeting;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\Project;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Task\Task;
use Task\TaskHydrator;
use Task\TaskRepository;
use User\User;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$orgarepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

$projectrepository =
    new ProjectRepository(Connection::get(),new ProjectHydrator());

$taskrepository =
    new TaskRepository(Connection::get(),new TaskHydrator());

$meetingrepository =
    new MeetingRepository(Connection::get(),new MeetingHydrator());


$idorga =  !empty($_GET['id']) ? $_GET['id'] : null;


if ($idorga) {
    // Récupération des user de l'organisation
    $usersoforga = $userrepository->fetchByOrganization($idorga);
    foreach ($usersoforga as $useroforga){
        /** @var User $user */
        $user = ((Object)$useroforga)->user;
        $orgarepository->deleteUser($user->getId(),$idorga);
    }
    // Récupération des project de l'organisation
    $projectsoforga = $projectrepository->fetchByIdOrganization($idorga);
    /** @var Project $projectoforga */
    foreach ($projectsoforga as $projectoforga){

        $tasks = $taskrepository->fetchByProject($projectoforga->getId());
        /** @var Task $task */
        foreach ($tasks as $task){
            $taskrepository->delete($task->getId());
        }

        $meetings = $meetingrepository->fetchByProject($projectoforga->getId());
        /** @var Meeting $meeting */
        foreach ($meetings as $meeting){
            $usersofmeeting = $userrepository->fetchByMeeting($meeting->getId());
            foreach ($usersofmeeting as $userofmeeting){
                $user = ((Object)$userofmeeting)->user;
                $meetingrepository->deleteUser($user->getId(),$meeting->getId());
            }
            $meetingrepository->delete($meetings->getId());
        }

        $usersofproject = $userrepository->fetchByProject($projectoforga->getId());
        foreach ($usersofproject as $userofproject){
            /** @var User $user */
            $user = ((Object)$userofproject)->user;
            $projectrepository->deleteUser($user->getId(),$projectoforga->getId());
        }
        $projectrepository->delete($projectoforga->getId());
    }
    $orgarepository->delete($idorga);
}


