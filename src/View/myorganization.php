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

$myorga = (object)$myorgas[0];

?>
<h1>
    Vous etes sur la page de l'organisation <?php echo $myorga->organization->getName() ?>
</h1>
<h3>
    Salut <?php echo ((object)$myorgas[0])->role ?>
</h3>

<div class="container" style="margin-top: 5em">
    <div>
        <h5>Liste des projets de l'organisation</h5>
    </div>
    <div>
        <table class="table">
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


