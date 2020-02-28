<?php

require_once '../src/Bootstrap.php';

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Connection::get(),$orgahydrator);
$projhydrator = new ProjectHydrator();
$projrepository = new ProjectRepository(Connection::get(),$projhydrator);
$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());
$authenticatorService = new AuthenticatorService($userrepository);


//TODO Faire bien mieux mais la je fatigue un peu
$myorgas = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());

$myorga = (object)$myorgas;
?>


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