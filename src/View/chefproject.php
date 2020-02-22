<?php

use Db\Connection;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;
use User\User;
use User\UserHydrator;
use User\UserRepository;

$projrepository = new ProjectRepository(Connection::get(), new ProjectHydrator());
$authenticatorService = new AuthenticatorService($userRepository);
$userprojects = $projrepository->fetchByUser($authenticatorService->getCurrentUserId());

$userRepository = new UserRepository(Connection::get(), new UserHydrator());

?>
<h2>
    Vous etes sur la page des projets en gestion
</h2>

<div class="container" style="margin-top: 5em">
    <?php
    foreach ($userprojects as $userproject) {
        /**
         * @var Project $project
         */
        $project = ((Object)$userproject)->project;?>
        <div class="row">
            <a onClick="toggleForm(<?= $project->getId() ?>)">
                <?php echo $project->getName() ?>
            </a>
            <div  id="project-<?= $project->getId() ?>" style="display: none; margin-left: 1em">
                <input type="hidden" id="name-<?= $project->getId() ?>" value="<?= $project->getName(); ?>">
                <input type="hidden" id="idorganization-<?= $project->getId() ?>" value="<?= $project->getIdorganization(); ?>">
                <input type="hidden" id="id-<?= $project->getId() ?>" value="<?= $project->getId(); ?>">
            </div>
        </div>
        <div >
            <div class="container"  id="UpdateProject-<?= $project->getId() ?>" style="display: none" >
            </div>
            <div class="row" style="display: none" id="ListUser-<?= $project->getId() ?>" >
                <div class="col" >
                    <label for="choix_users">Liste des users du projet: </label>
                    <?php
                    $usersofproject = $userRepository->fetchByProject($project->getId());
                    foreach ($usersofproject as $userofproject) {
                        /** @var User $user */
                        $user = ((Object)$userofproject)->user;?>
                        <div>
                            <? echo $user->getName(); ?>
                        </div>
                    <?}?>
                </div>
                <div class="col">
                    <label for="choix_users">Liste des users : </label>
                    <input list="users-<?= $project->getId() ?>" type="text" id="choix_users-<?= $project->getId() ?>" name="choix_users-<?= $project->getId() ?>">
                    <datalist id="users-<?= $project->getId() ?>">
                        <?php
                        $usersoforganization = $userRepository->fetchByOrganizationNotInProject($project->getId());
                        foreach ($usersoforganization as $useroforganization) {
                        /** @var User $user */
                        $user = ((object)$useroforganization)->user;?>
                        <option value="<?php echo $user->getName() ?>" data-value=<?php echo $user->getId() ?>>
                            <?php } ?>
                    </datalist>
                </div>
            </div>

        </div>

        <?php
    }
    ?>
</div>




<script type="text/javascript">
    function toggleForm(id) {

        $('#UpdateProject-' + id).load('updateproject.php', {
            name: $('#name-' + id).val(),
            idorganization: $('#idorganization-' + id).val(),
            id: $('#id-' + id).val()
        }).toggle("slow");
        $('#ListUser-' + id).toggle("slow");
    }




</script>