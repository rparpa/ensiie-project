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
                        <?php include_once 'field_usersofproject.php' ?>
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
                        <?php include_once 'field_tasksofproject.php' ?>
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
                        <?php include_once 'field_meetingsofproject.php' ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

