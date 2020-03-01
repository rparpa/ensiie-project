<?php

use Db\Connection;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;

$projhydrator = new ProjectHydrator();
$projrepository = new ProjectRepository(Connection::get(),$projhydrator);
$authenticatorService = new AuthenticatorService($userRepository);


?>
<h1 align="center" style="margin: 1em">
    Vous etes sur la page de mes projets
</h1>


<div class="container" style="margin-top: 5em">
    <div>
        <h5>Liste de mes projets</h5>
    </div>
    <div>
        <table class="table" id="list-project">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Mon role</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $userprojects = $projrepository->fetchByUser($authenticatorService->getCurrentUserId());

            foreach ($userprojects as $userproject) {
                /** @var Project $project */
                $project = ((Object)$userproject)->project?>
                <tr id="project-<?php  echo $project->getId() ?>">
                    <th scope="row" ><?php  echo $project->getId() ?></th>
                    <td><?php  echo $project->getName() ?></td>
                    <td><?php  echo ((Object)$userproject)->role ?></td>
                    <td><?php  echo $project->getCreationdate()->format("Y-m-d H:i:s") ?></td>
                    <td>
                        <button type="submit" onclick="location.href='projectconsultation.php?idproject=<?php  echo $project->getId(); ?>'" >Consulter</button>
                    </td>
                    <td>
                        <button type="submit" onclick="Deleteuserofproject('<?php  echo $project->getId(); ?>')" >Quitter le projet</button>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<script>

    function Deleteuserofproject(idproject) {
        $.get({
            url:'deleteuserofproject.php',
            data:{
                iduser:<? echo $authenticatorService->getCurrentUserId()?>,
                idproject:idproject
            }
        }
        );
        $('#project-'+ idproject).remove();
    }




</script>