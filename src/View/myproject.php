<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use Project\Project;

$projhydrator = new ProjectHydrator();
$projrepository = new ProjectRepository(Connection::get(),$projhydrator);
$authenticatorService = new AuthenticatorService($userRepository);


//TODO Faire bien mieux mais la je fatigue un peu

?>
<h1>
    Vous etes sur la page de mes projets
</h1>


<div class="container" style="margin-top: 5em">
    <div>
        <span>Liste de mes projets</span>
    </div>
    <div>
        <table class="table">
            <?php
            $userprojects = $projrepository->fetchByUser($authenticatorService->getCurrentUserId());

            foreach ($userprojects as $userproject) {
                /** @var Project $project */
                $project = ((Object)$userproject)->project?>
                <tr>
                    <td>
                       Nom du projet :<?php  echo $project->getName() ?>
                    </td>
                    <td>
                       Mon role : <?php  echo ((Object)$userproject)->role ?>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>

<!--$projects[] = [
"project" => $this->projectHydrator->hydrateObj($row),
"role" => $row->role,
"date" => $row->date
];-->
