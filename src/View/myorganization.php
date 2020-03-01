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


$userorga = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());

if(!$userorga){?>
    <h1 align="center" style="margin: 2em">
        Vous n'etes pas membre d'une organisation.
    </h1>
    <h4 align="center" style="margin: 1em">
        Contactez votre administrateur
    </h4>
<?}
else{
    $myorga = (object)$userorga;
    ?>
    <h1 align="center" style="margin: 1em">
        Vous etes sur la page de l'organisation <?php echo $myorga->organization->getName() ?>
    </h1>
    <h3>
        Salut <?php echo $myorga->role ?>
    </h3>

    <div class="row">
        <div class="formulaire" id="form-add-project-to-my-orga">
            <div class="container-fluid">
                <div class="form-row" align="center">
                    <legend>Projet </legend>
                </div>
                <div class="form-row">
                    <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-row">
                    <span id="nameEmpty"></span>
                </div>
                <div class="form-row">
                    <span id="existproject"></span>
                </div>
                <div class="form-row">
                    <input type="hidden" id="idorganization" name="idorganization" value="<?php echo $myorga->organization->getId() ?>">
                </div>
                <div class="form-row">
                    <button type="submit"
                            onclick="addProjectToMyOrga()">Ajouter</button>
                </div>
            </div>
        </div>
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
                                <button id="button-add-responsable"
                                        onclick="add_responsable_project(<?php  echo $project->getId() ?>)"
                                >Ajouter <br/>un responsable</button>
                            <?}?>
                        </td>
                        <td>
                            <button id="button-delete-project"
                                    onclick="delete_project(<?php  echo $project->getId() ?>)"
                            >Supprimer <br/>le projet</button>
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
                        <button
                                onclick="saveResponsableProject()"
                                type="submit">Ajouter Responsable</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function delete_project(idproject) {
            $.get({
                url:'deleteproject.php',
                data:{
                    idproject:idproject
                },
                success:function () {
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
            })
        }

        function add_responsable_project(idproject){
            $("#modal-idproject").val(idproject);
            $("#ModalAddresponsable").modal("show");
        }

        function saveResponsableProject(){
            var index = $("#modal-user-responsable").prop("selectedIndex");
            if(index>=0){
                //var iduser = <? echo $authenticatorService->getCurrentUserId(); ?>;
                var iduser = $("#modal-user-responsable").find(':selected').attr('data-id');
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
                        document.getElementsByName('button-add-responsable'+idproject)[0].hidden = true;

                    }
                })
            }
        }

        function addProjectToMyOrga(){
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
                                        $('#name').val("");
                                    }
                                }
                            )
                        }
                        else{
                            for(var key in data) {
                                $('#' + key).html(data[key])
                            }
                        }

                    }
                });
        }


        document.getElementById("name").addEventListener('keyup', function (event) {
            document.getElementById('nameEmpty').innerHTML = "";
            document.getElementById('existproject').innerHTML = "";
        })

    </script>


<?php }?>