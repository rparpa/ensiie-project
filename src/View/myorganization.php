<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;
use User\User;
use User\UserHydrator;
use User\UserRepository;

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Connection::get(),$orgahydrator);
$projhydrator = new ProjectHydrator();
$projrepository = new ProjectRepository(Connection::get(),$projhydrator);
$authenticatorService = new AuthenticatorService($userRepository);
$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());


//TODO Faire bien mieux mais la je fatigue un peu
$myorgas = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());

$myorga = (object)$myorgas;

?>
<h1>
    Vous etes sur la page de l'organisation <?php echo $myorga->organization->getName() ?>
</h1>
<h3>
    Salut <?php echo ((object)$myorgas)->role ?>
</h3>

<div class="row">
    <form class="formulaire" id="form-add-project-to-my-orga">
        <div class="container-fluid">
            <div class="form-row" align="center">
                <legend>Projet </legend>
            </div>
            <div class="form-row">
                <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
                <input type="text" value="" name="name" id="name" required="">
                <span class="error" aria-live="polite" id="errorname"></span>
            </div>
            <div class="form-row">
                <?php if (isset($data['nameAlreadyExist'])): ?>
                    <span class="error-message" ><?= $data['nameAlreadyExist'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <?php if (isset($data['nameEmpty'])): ?>
                    <span class="error-message"><?= $data['nameEmpty'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <input type="hidden" id="idorganization" name="idorganization" value="<?php echo $myorga->organization->getId() ?>">
            </div>
            <div class="form-row">
                <button type="submit">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<div class="container" style="margin-top: 5em">
    <div>
        <h5>Liste des projets de l'organisation</h5>
    </div>
    <div>
        <table class="table" id="tab-project-my-orga">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $projects = $projrepository->fetchByIdOrganization($myorga->organization->getId());
            /** @var Project $project */
            foreach ($projects as $project) { ?>
                <tr>
                    <th scope="row" ><?php  echo $project->getId() ?></th>
                    <td><?php  echo $project->getName() ?></td>
                    <td><?php  echo $project->getCreationdate()->format("Y-m-d H:i:s") ?></td>
                    <td>
                        <? if(!$projrepository->hasResponableByIdProject($project->getId())){?>
                        <button id="button-add-responsable" name="button-add-responsable-<?php  echo $project->getId() ?>" data-id="<?php  echo $project->getId() ?>" >Ajouter un responsable</button>
                        <?}?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal HTML -->
<div id="ModalAddresponsable" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-modal-responsable">
                <div class="modal-header">
                    <h5 class="modal-title">Choisir un responsable</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label >Responsable</label>
                            <input type="hidden" id="modal-idproject">
                        </div>
                        <div class="col">
                            <select id="modal-user-responsable" required>
                                <option></option>
                                <?
                                $usersoforga = $userrepository->fetchByOrganization($myorga->organization->getId());
                                foreach ($usersoforga as $useroforga) {
                                /** @var User $user */
                                $user = ((Object)$useroforga)->user;
                                ?>
                                <option data-id="<? echo $user->getId();?>"><? echo $user->getSurname() . ' ' . $user->getName() ?></option>
                                <? }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit">Ajouter Taches</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(function(){
        $('#form-modal-responsable').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            var index = $("#modal-user-responsable").prop("selectedIndex");
            if(index>=0){
                var iduser = <? echo $authenticatorService->getCurrentUserId(); ?>;
                var idproject = $("#modal-idproject").val();
                var role = "Chef";
                $.get({
                    url: 'addusertoproject.php',
                    data: {
                        iduser:iduser,
                        role:role,
                        idproject:idproject
                    },
                    success:function () {
                        $('#ModalAddresponsable').modal('hide');
                        document.getElementsByName('button-add-responsable-'+idproject)[0].hidden = true;

                    }
                })
            }
        })
    });

    $(function(){
        $('#form-add-project-to-my-orga').submit(function(event){
            // cancels the form submission
            event.preventDefault();
            var name = $("#name").val();
            var idorganization = $("#idorganization").val();
            $.get(
                {
                    url: 'addproject.php',
                    data: {
                        name:name,
                        idorganization:idorganization
                    },
                    datatype:'json',
                    success:function (json) {
                        var data = JSON.parse(json);
                        if(Object.keys(data).length==0){
                            $.get(
                                {
                                    url: 'table_projectoforganization.php',
                                    datatype:'html',
                                    success:function (html) {
                                        $('#tab-project-my-orga').replaceWith(html);
                                    }
                                }
                            )
                        }
                        else{
                            for(var key in data) alert(data[key])
                        }

                    }
                });
        })
    });

    document.getElementById("button-add-responsable").addEventListener('click', function () {
        $("#modal-idproject").val(this.attributes['data-id'].value);
        $("#ModalAddresponsable").modal("show");
    });

</script>


