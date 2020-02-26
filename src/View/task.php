<?php


use Db\Connection;
use Service\AuthenticatorService;
use Task\Task;
use User\UserHydrator;
use User\UserRepository;

$idproject = 1;
$task= null;

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

$authenticatorService = new AuthenticatorService($userrepository);
$user = $authenticatorService->getCurrentUser();

?>


<form class="formulaire" id="AddorUpdateTask">
    <div class="container-fluid">
        <div class="form-row" align="center">
            <legend>Tache</legend>
        </div>
        <input type="hidden" value="<?php echo $task?$task->getId():'' ?>" name="id">
        <div class="form-row">
            <div class="col">
                <label class="label-lenght-fix" for="title">Title : <em>*</em></label>
            </div>
            <div class="col">
                <input type="text"
                       value="<?php echo $task?$task->getTitle():'' ?>"
                       name="title"
                       id="title"
                       required>
                <span class="error" aria-live="polite" id="errortitle"></span>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label class="label-lenght-fix" for="content">Content : <em>*</em></label>
            </div>
            <div class="col">
                <input type="text"
                       value="<?php echo $task?$task->getContent():'' ?>"
                       name="content"
                       id="content"
                       required>
                <span class="error" aria-live="polite" id="errorcontent"></span>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label class="label-lenght-fix" for="state">State : <em>*</em></label>
            </div>
            <div class="col">
                <input type="text"
                       value="<?php echo $task?$task->getState():'' ?>"
                       name="state" id="state" required="">
                <span class="error" aria-live="polite" id="errorstate"></span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <label class="label-lenght-fix" for="content">Content : <em>*</em></label>
        </div>
        <div class="col">
            <textarea type="text" value="" name="content" id="content" required></textarea>
            <span class="error" aria-live="polite" id="errorcontent"></span>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label class="label-lenght-fix" for="assignee">Responsable : <em>*</em></label>
        </div>
        <div class="col">
            <input type="hidden" id="idassignee" value="<?php echo $task?$task->getIdassignee():'1' ?>">
            <select id="select-user-assignee">
                <?
                $usersoforganization = $userrepository->fetchByOrganization($user->getId());
                foreach ($usersoforganization as $useroforganization) {
                /** @var User $user */
                $user = ((Object)$useroforganization)->user;
                ?>
                <option data-id="<? echo $user->getId();?>"><? echo $user->getSurname() . ' ' . $user->getName()?></option>
                <? }?>
            </select>
            <span class="error" aria-live="polite" id="errorassignee"></span>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <button type="submit" >Modifier/Ajouter</button>
        </div>
    </div>
</form>

<script>

    window.onloadend = function () {
        if($('#idassignee').val()!=='') {
            alert("yolo");
            $('#select-user-assignee').val("")
        }
    };


    $(function(){
        $('#AddorUpdateTask').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            submit_task();
        })
    })


    function submit_task() {
        var id = $("#id").val();
        var title = $("#title").val();
        var content = $("#content").val();
        var state = $("#state").val();
        var idassignee = $("#select-user-assignee").find(':selected').attr('data-id');
        $.get({
            url:"addtask.php",
            data:{
                id:id,
                title:title,
                content:content,
                state:state,
                idcreator:<? echo $task?$task->getIdcreator():$authenticatorService->getCurrentUserId();?>,
                idassignee:idassignee,
                idproject:<? echo $idproject;?>
            }
        })
    }


</script>
