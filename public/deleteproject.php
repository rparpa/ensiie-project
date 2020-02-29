<?php

use Db\Connection;
use Meeting\Meeting;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
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

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());

$orgarepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

$taskrepository =
    new TaskRepository(Connection::get(),new TaskHydrator());

$meetingrepository =
    new MeetingRepository(Connection::get(),new MeetingHydrator());


$idproject =  !empty($_GET['idproject']) ? $_GET['idproject'] : null;


if ($idproject) {

    $tasks = $taskrepository->fetchByProject($idproject);
    /** @var Task $task */
    foreach ($tasks as $task){
        $taskrepository->delete($task->getId());
    }

    $meetings = $meetingrepository->fetchByProject($idproject);
    /** @var Meeting $meeting */
    foreach ($meetings as $meeting){
        $usersofmeeting = $userrepository->fetchByMeeting($meeting->getId());
        foreach ($usersofmeeting as $userofmeeting){
            $user = ((Object)$userofmeeting)->user;
            $meetingrepository->deleteUser($user->getId(),$meeting->getId());
        }
        $meetingrepository->delete($meetings->getId());
    }

    $usersofproject = $userrepository->fetchByProject($idproject);
    foreach ($usersofproject as $userofproject){
        /** @var User $user */
        $user = ((Object)$userofproject)->user;
        $projectrepository->deleteUser($user->getId(),$idproject);
    }
    $projectrepository->delete($idproject);
}

echo json_encode($viewData);

