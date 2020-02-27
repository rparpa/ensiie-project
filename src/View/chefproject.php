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

<div class="container" style="margin-top: 5em">
    <div>
        <h5>Liste de mes projets</h5>
    </div>
    <table class="table" id="listchefprojects">
        <?php
        $userprojects = $projrepository->fetchByUserByRole($authenticatorService->getCurrentUserId(), 'Chef');
        foreach ($userprojects as $userproject) {
            /** @var Project $project*/
            $project = ((Object)$userproject)->project;?>
            <tr class="container" id="row-project-<? echo $project->getId()?>" >
                <td class="row">
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
                </td>
                <td class="row" id="listusers-<? echo $project->getId()?>" style="display: none;" >
                    <div>
                        <h6>Collaborateurs</h6>
                    </div>
                    <table class="table">
                        <? $usersofproject = $userRepository->fetchByProject($project->getId());
                        foreach ($usersofproject as $userofproject) {
                            /** @var User $user */
                            $user = ((Object)$userofproject)->user;
                            ?>
                            <tr id="<? echo $user->getId(); ?>">
                                <td>
                                    <? echo $user->getName(); ?>
                                </td>
                            </tr>
                        <? }?>
                    </table>
                </td>
                <td class="row" id="listtasks-<? echo $project->getId()?>" style="display: none;">
                    <div>
                        <h6>Taches</h6>
                    </div>
                    <table class="table">
                        <? $taskssofproject = $taskrepository->fetchByProject($project->getId());
                        /** @var Task $task */
                        foreach ($taskssofproject as $task) {
                            /** @var Task $task */
                            ?>
                            <tr>
                                <td>
                                    <? echo $task->getTitle(); ?>  <? echo $task->getContent()?>
                                </td>
                            </tr>
                        <? }?>
                    </table>
                </td>
                <td class="row" id="listmeetings-<? echo $project->getId()?>" style="display: none;">
                    <div>
                        <h6>Réunions</h6>
                    </div>
                    <table class="table">
                        <? $meetingssofproject = $meetingrepository->fetchByProject($project->getId());
                        /** @var Meeting $meeting */
                        foreach ($meetingssofproject as $meeting) {
                            ?>
                            <tr>
                                <td>
                                    <? echo $meeting->getName(); ?>  <? echo $meeting->getDescription()?> <? echo $meeting->getPlace()?>
                                </td>
                            </tr>
                        <? }?>
                    </table>
                </td>
            </tr>
        <?}?>
    </table>
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