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


<!-- Modal HTML -->
<div id="Modaltask" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un tache</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col">
                        <label >Title</label>
                    </div>
                    <div class="col">
                        <input id="modal-task-title">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >Content</label>
                    </div>
                    <div class="col">
                        <textarea id="modal-task-content"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >State</label>
                    </div>
                    <div class="col">
                        <input id="modal-task-state" value="Assignée">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >Responsable</label>
                    </div>
                    <div class="col">
                        <select id="modal-task-assignee">
                            <option></option>
                            <?php
                            //TODO corriger avec un vrai idorga
                            $useroforga = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());
                            $usersoforga = $userrepository->fetchByOrganization(((object)$useroforga)->organization->getId());
                            foreach ($usersoforga as $useroforga) {
                            /** @var User $user */
                            $user = ((Object)$useroforga)->user;?>
                            <option data-id="<? echo $user->getId()?>"><?php echo $user->getSurname() . ' ' . $user->getName() ?></option>
                            <? }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" >Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>

    document.getElementById("button-user-add").addEventListener('click', function () {
        var index = $("#select-user-add").prop("selectedIndex");
        if(index>=0){
            var iduser = $("#select-user-add").find(':selected').attr('data-id');
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
        $("#Modaltask").modal("show");
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

    function submit_modal_task() {
        var title = $("#modal-task-title").val();
        var content = $("#modal-task-content").val();
        var state = $("#modal-task-state").val();
        var idassignee = $("#modal-task-assignee").find(':selected').attr('data-id');
        $.post({
            type:"GET",
            url:"addtask.php",
            data:{
                title:title,
                content:content,
                state:state,
                idcreator:<? echo $authenticatorService->getCurrentUserId();?>,
                idassignee:idassignee,
                idproject:<? echo $idproject;?>
            },success:refreshtask
        }).done(function () {
            $('#Modaltask').modal('hide')
        })
    }

    $(function(){
        $('form').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            submit_modal_task();
        })
    })

</script>