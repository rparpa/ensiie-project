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
<div id="ModalAddtask" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-modal-task">
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
                        <input id="modal-task-title" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >Content</label>
                    </div>
                    <div class="col">
                        <textarea id="modal-task-content" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >State</label>
                    </div>
                    <div class="col">
                        <input id="modal-task-state" value="Assignée" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label >Responsable</label>
                    </div>
                    <div class="col">
                        <select id="modal-task-assignee" required>
                            <option></option>
                            <?php
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
                <button type="submit" >Ajouter Taches</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="ModalAddmeeting" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-modal-meeting">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout d'une réunion</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label >Name</label>
                        </div>
                        <div class="col">
                            <input id="modal-meeting-name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label >Description</label>
                        </div>
                        <div class="col">
                            <textarea id="modal-meeting-description" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label >Place</label>
                        </div>
                        <div class="col">
                            <input id="modal-meeting-place" value="Bureau invisible" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label >Participant(s)</label>
                        </div>
                        <div class="col">
                            <select id='modal-meeting-users' multiple='multiple'>
                                <?php
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
                    <button type="submit" >Ajouter Réunion</button>
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
            // Forcement un Larbin
            var role = "Larbin";
            $.get({
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
        $("#ModalAddtask").modal("show");
    });

    document.getElementById("button-meeting-add").addEventListener('click', function () {
        $("#ModalAddmeeting").modal("show");
    });


    document.getElementById("button-user-delete").addEventListener('click', function () {
        var checkboxs = document.getElementsByName("check-user-delete");
        for (var checkbox of checkboxs){
            if(checkbox.checked){
                var iduser = checkbox.attributes["data-iduser"].value;
                $.get({
                    url: 'deleteuserofproject.php',
                    data: {
                        iduser:iduser,
                        idproject:<?php echo $idproject; ?>
                    },success:refreshuser
                });
            }
        }
    });

    document.getElementById("button-task-delete").addEventListener('click', function () {
        var checkboxs = document.getElementsByName("check-task-delete");
        for (var checkbox of checkboxs) {
            if (checkbox.checked) {
                var idtask = checkbox.attributes["data-idtask"].value;
                $.get({
                    url: 'deletetaskofproject.php',
                    data: {
                        idtask:idtask
                    },success:refreshtask
                });
            }
        }
    });

    document.getElementById("button-meeting-delete").addEventListener('click', function () {
        var checkboxs = document.getElementsByName("check-meeting-delete");
        for (var checkbox of checkboxs) {
            if (checkbox.checked) {
                var idmeeting = checkbox.attributes["data-idmeeting"].value;
                $.get({
                    url: 'deletemeetingofproject.php',
                    data: {
                        idmeeting:idmeeting
                    },success:refreshmeeting
                });
            }
        }
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
        $.get({
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
            $('#ModalAddtask').modal('hide')
        })
    }

    function submit_modal_meeting() {
        var name = $('#modal-meeting-name').val();
        var place = $('#modal-meeting-place').val();
        var description = $('#modal-meeting-description').val();
        $.get({
            url:"addmeeting.php",
            data:{
                name:name,
                place:place,
                description:description,
                idsource:<? echo $idproject;?>,
                source:"project"
            },success:refreshmeeting
        }).done(function () {
            $('#ModalAddmeeting').modal('hide')
        })
    }

    $(function(){
        $('#form-modal-task').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            submit_modal_task();
        })
    })

    $(function(){
        $('#form-modal-meeting').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            submit_modal_meeting();
        })
    })

</script>