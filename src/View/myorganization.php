<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Connection::get(),$orgahydrator);
$projhydrator = new ProjectHydrator();
$projrepository = new ProjectRepository(Connection::get(),$projhydrator);
$authenticatorService = new AuthenticatorService($userRepository);


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
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<script>

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
    })

</script>


