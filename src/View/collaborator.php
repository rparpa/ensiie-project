<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;
use Service\AuthenticatorService;
use Project\Project;
use Organization\OrganizationRepository;
use Organization\OrganizationHydrator;

$userhydrator = new UserHydrator();
$authenticatorService = new AuthenticatorService($userRepository);
$organizationHydrator = new OrganizationHydrator();
$organizationRepository = new OrganizationRepository(Connection::get() ,$organizationHydrator);

$org = ((Object) $organizationRepository->fetchByUser($authenticatorService->getCurrentUserId()))->organization;
//TODO Faire bien mieux mais la je fatigue un peu

?>
<h1>
    Collaborateurs de l'organisation <?php echo $org->getName() ?>
</h1>


<div class="container" style="margin-top: 5em">
    <div>
        <h5>Collaborateurs</h5>
    </div>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Date d'inscription</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $collabs = $userRepository->fetchByOrganization($authenticatorService->getCurrentUserId());
            foreach ($collabs as $collab) {
                /** @var User $collab */
                $collab = ((Object)$collab)->user?>
                <tr onclick="ShowAlert()" name="<?php  echo $collab->getId() ?>">
                    <th scope="row" ><?php  echo $collab->getId() ?></th>
                    <td><?php  echo $collab->getUsername() ?></td>
                    <td><?php  echo $collab->getName() ?></td>
                    <td><?php  echo $collab->getSurname() ?></td>
                    <td><?php  echo $collab->getMail() ?></td>
                    <td><?php  echo $collab->getCreationdate()->format("Y-m-d H:i:s") ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function ShowAlert() {
        alert("Un truc cool a faire je pense!!")
    }

</script>