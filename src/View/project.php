<?php
use Db\Connection;
use Meeting\Meeting;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
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
                        <select id="select-user-add">
                            <? $usersoforganization = $userrepository->fetchByOrganizationNotInProject($idproject);
                            foreach ($usersoforganization as $useroforganization) {
                                /** @var User $user */
                                $user = ((Object)$useroforganization)->user;
                                ?>
                            <option data-id="<? echo $user->getId();?>"><? echo $user->getName()?></option>
                            <? }?>
                        </select>
                    </div>
                    <div class="col">
                        <button id="button-add" >Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset>
                        <? $usersofproject = $userrepository->fetchByProject($idproject);
                        foreach ($usersofproject as $userofproject) {
                            /** @var User $user */
                            $user = ((Object)$userofproject)->user;?>
                            <div>
                                <label for="nameuser"><? echo $user->getSurname(); ?> <? echo $user->getName(); ?> </label>
                                <input type="checkbox" value data-iduser="<? $user->getId()?>">
                            </div>
                        <? }?>
                    </fieldset>
                </div>
                <div class="row">
                    <button>Supprimer</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Taches</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <button>Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset>
                        <? $tasksofproject = $taskrepository->fetchByProject($idproject);
                        foreach ($tasksofproject as $taskofproject) {
                            /** @var Task $task */
                            $task = ((Object)$taskofproject)->task;?>
                            <div>
                                <label for="nametask"><? echo $task->getTitle(); ?> <? echo $task->getContent(); ?> </label>
                                <input type="checkbox" value data-iduser="<? $task->getId()?>">
                            </div>
                        <? }?>
                    </fieldset>
                </div>
                <div class="row">
                    <button>Supprimer</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Réunions</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <button>Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset>
                        <? $meetingsofproject = $meetingrepository->fetchByProject($idproject);
                        foreach ($meetingsofproject as $meetingofproject) {
                            /** @var Meeting $meeting */
                            $meeting = ((Object)$meetingofproject)->meeting;?>
                            <div>
                                <label for="namemeeting"><? echo $meeting->getName(); ?> <? echo $meeting->getDescription(); ?> </label>
                                <input type="checkbox" value data-iduser="<? $meeting->getId()?>">
                            </div>
                        <? }?>
                    </fieldset>
                </div>
                <div class="row">
                    <button>Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById("button-add").addEventListener('click', function () {
        var select = document.getElementById("select-user-add");
        var index = select.selectedIndex;
        var iduser = select.options[index].attributes["data-id"].value;
        //TODO ajouter une saisie lors de la selection
        var role = "Larbin";
        $.ajax({
            type: 'GET',
            url: 'addusertoproject.php',
            data: {
                iduser:iduser,
                role:role,
                idproject:<?php echo $idproject; ?>
            }
        });
    })



</script>
