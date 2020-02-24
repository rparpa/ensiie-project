<?php

use Db\Connection;
use Meeting\Meeting;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;
use Task\TaskHydrator;
use Task\TaskRepository;
use User\User;
use User\UserHydrator;
use User\UserRepository;

$projrepository = new ProjectRepository(Connection::get(), new ProjectHydrator());
$taskrepository = new TaskRepository(Connection::get(), new TaskHydrator());
$meetingrepository = new MeetingRepository(Connection::get(), new MeetingHydrator());
$authenticatorService = new AuthenticatorService($userRepository);
$userRepository = new UserRepository(Connection::get(), new UserHydrator());



?>
<h2>
    Vous etes sur la page des projets en gestion
</h2>


<div class="container-fluid" id="listchefprojects">
    <?php
    $userprojects = $projrepository->fetchByUser($authenticatorService->getCurrentUserId());
    foreach ($userprojects as $userproject) {
    /** @var Project $project*/
    $project = ((Object)$userproject)->project;?>
    <div class="container" id="row-project-<? echo $project->getId()?>" >
        <div class="row">
            <div class="col">
                <? echo $project->getName()?>
            </div>
            <div class="col">
                <button name="button-collaborateurs" id="<? echo $project->getId()?>">Collaborateurs</button>
            </div>
            <div class="col">
                <button name="button-taches" id="<? echo $project->getId()?>" >Taches</button>
            </div>
            <div class="col">
                <button name="button-reunions" id="<? echo $project->getId()?>">Réunions</button>
            </div>
            <div class="col">
                <button name="button-gerer" id="<? echo $project->getId()?>" onclick="location.href='project.php?idproject=<? echo $project->getId()?>'">Gerer</button>
            </div>
        </div>
        <div class="row" id="listusers-<? echo $project->getId()?>" style="display: none;" >
            <? $usersofproject = $userRepository->fetchByProject($project->getId());
            foreach ($usersofproject as $userofproject) {
            /** @var User $user */
            $user = ((Object)$userofproject)->user;
            ?>
            <ul>
                <il>
                    <? echo $user->getName(); ?>
                </il>
            </ul>
            <? }?>
        </div>
        <div class="row" id="listtasks-<? echo $project->getId()?>" style="display: none;">
            <? $taskssofproject = $taskrepository->fetchByProject($project->getId());
            foreach ($taskssofproject as $tasksofproject) {
                /** @var Task $task */
                $task = ((Object)$tasksofproject)->task;
                ?>
                <ul>
                    <il>
                        <? echo $task->getTitle(); ?>  <? echo $task->getContent()?>
                    </il>
                </ul>
            <? }?>
        </div>
        <div class="row" id="listmeetings-<? echo $project->getId()?>" style="display: none;">
            <? $meetingssofproject = $meetingrepository->fetchByProject($project->getId());
            foreach ($meetingssofproject as $meetingsofproject) {
                /** @var Meeting $meeting */
                $meeting = ((Object)$meetingsofproject)->meeting;
                ?>
                <ul>
                    <il>
                        <? echo $meeting->getName(); ?>  <? echo $meeting->getDescription()?> <? echo $meeting->getPlace()?>
                    </il>
                </ul>
            <? }?>
        </div>
    </div>
    <?}?>
</div>




<script type="text/javascript">

    var buttons = document.getElementById("listchefprojects");

    buttons.addEventListener('click', function (e) {
        switch (e.target.name) {
            case "button-collaborateurs":
                $('#listusers-' + e.target.id).toggle("slow");
                break;
            case "button-taches":
                $('#listtasks-' + e.target.id).toggle("slow");
                break;
            case "button-reunions":
                $('#listmeetings-' + e.target.id).toggle("slow");
                break;
        }
    })






</script>