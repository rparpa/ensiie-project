<?php
use Db\Connection;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Task\TaskHydrator;
use Task\TaskRepository;
use User\User;
use User\UserHydrator;
use User\UserRepository;


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());
$taskrepository =
    new TaskRepository(Connection::get(), new TaskHydrator());
$meetingrepository =
    new MeetingRepository(Connection::get(), new MeetingHydrator());
$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

$orgarepository =
    new OrganizationRepository(Connection::get(),new OrganizationHydrator());

$authenticatorService =
    new AuthenticatorService($userrepository);


$idproject =  !empty($data['idproject']) ? $data['idproject'] : null;

?>

<div class="container">
    <legende>Project</legende>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <h2>Collaborateurs</h2>
                </div>
                <div class="row">
                    <div class="col">
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-user-delete">
                        <?$usersofproject = $userrepository->fetchByProject($idproject);
                        foreach ($usersofproject as $userofproject) {
                        /** @var User $user */
                        $user = ((Object)$userofproject)->user;?>
                        <div>
                            <label for="nameuser"><? echo $user->getSurname(); ?> <? echo $user->getName(); ?> </label>
                        </div>
                        <? }?>
                    </fieldset>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Taches</h2>
                </div>
                <div class="row">
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-task-delete">
                        <? $tasksofproject = $taskrepository->fetchByProject($idproject);
                        /** @var Task $taskofproject */
                        foreach ($tasksofproject as $taskofproject) {?>
                        <div>
                            <label for="nametask"><? echo $taskofproject->getTitle(); ?> <? echo $taskofproject->getContent(); ?> </label>
                        </div>
                        <? }?>
                    </fieldset>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Réunions</h2>
                </div>
                <div class="row">
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-meeting-delete">
                        <? $meetingsofproject = $meetingrepository->fetchByProject($idproject);
                        /** @var Meeting $meeting */
                        foreach ($meetingsofproject as $meeting) {?>
                        <div>
                            <label for="namemeeting"><? echo $meeting->getName(); ?> <? echo $meeting->getDescription(); ?> </label>
                        </div>
                        <? }?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

