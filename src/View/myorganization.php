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
        <span>Liste des projets de l'organisation</span>
    </div>
    <div>
        <table class="table">
            <?php
            $projects = $projrepository->fetchByIdOrganization($myorga->organization->getId());
            /** @var Project $project */
            foreach ($projects as $project) { ?>
                <tr>
                    <td>
                        <?php  echo $project->getName() ?>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>


