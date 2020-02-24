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
                            <?php include_once 'select_usersoforganization.php' ?>
                        </select>
                    </div>
                    <div class="col">
                        <button id="button-user-add" >Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-user-delete">
                        <?php include_once 'field_usersofproject.php' ?>
                    </fieldset>
                </div>
                <div class="row">
                    <button id="button-user-delete" >Supprimer</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Taches</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <button id="button-task-add">Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-task-delete">
                        <?php include_once 'field_tasksofproject.php' ?>
                    </fieldset>
                </div>
                <div class="row">
                    <button id="button-task-delete">Supprimer</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Réunions</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <button id="button-meeting-add">Ajouter</button>
                    </div>
                </div>
                <div class="row" style="min-height: 15em;" >
                    <fieldset id="field-meeting-delete">
                        <?php include_once 'field_meetingsofproject.php' ?>
                    </fieldset>
                </div>
                <div class="row">
                    <button id="button-meeting-delete" >Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById("button-user-add").addEventListener('click', function () {
        var select = document.getElementById("select-user-add");
        var index = select.selectedIndex;
        if(index>=0){
            var iduser = select.options[index].attributes["data-id"].value;
            //TODO ajouter une saisie lors de la selection
            var role = "Larbin";
            $.post({
                type: 'GET',
                url: 'addusertoproject.php',
                data: {
                    iduser:iduser,
                    role:role,
                    idproject:<?php echo $idproject; ?>
                },success:refreshuser
            });
        }
    });

    document.getElementById("button-task-add").addEventListener('click', function () {
        alert('TODO');
    });

    document.getElementById("button-meeting-add").addEventListener('click', function () {
        alert('TODO');
    });


    document.getElementById("button-user-delete").addEventListener('click', function () {
        var checkboxs = document.getElementsByName("check-user-delete");
        for (var checkbox of checkboxs){
            if(checkbox.checked){
                var iduser = checkbox.attributes["data-iduser"].value;
                $.post({
                    type: 'GET',
                    url: 'deleteusertoproject.php',
                    data: {
                        iduser:iduser,
                        idproject:<?php echo $idproject; ?>
                    },success:refreshuser
                });
            }
        }
    });

    document.getElementById("button-task-delete").addEventListener('click', function () {
        alert('TODO');
    });

    document.getElementById("button-meeting-delete").addEventListener('click', function () {
        alert('TODO');
    });

    function refreshuser() {
        var data = {idproject:<?echo $idproject;?>};
        $('#field-user-delete').load('field_usersofproject.php',data);
        $('#select-user-add').load('select_usersoforganization.php', data);
    }

    function refreshtask() {
        var $data = {idproject:<?echo $idproject;?>};
        $('#field-task-delete').load('field_tasksofproject.php',$data);
    }

    function refreshmeeting() {
        var $data = {idproject:<?echo $idproject;?>};
        $('#field-meeting-delete').load('field_meetingsofproject.php',$data);
    }
</script>
