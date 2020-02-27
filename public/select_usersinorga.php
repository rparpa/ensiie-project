<?php

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use User\User;
use User\UserHydrator;
use User\UserRepository;
use Organization\OrganizationRepository;
use Organization\OrganizationHydrator;

$organizationHydrator = new OrganizationHydrator();
$organizationRepository = new OrganizationRepository(Connection::get(), $organizationHydrator);
$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$org = ((object) $organizationRepository->fetchByUser($authenticatorService->getCurrentUserId()))->organization;
$collabs = $userRepository->fetchByOrganization($org->getId());
foreach ($collabs as $collab) {
    /** @var User $collab */
    $collab = ((object) $collab)->user ?>
    <tr name="<?php echo $collab->getId() ?>">
        <th scope="row"><?php echo $collab->getId() ?></th>
        <td><?php echo $collab->getUsername() ?></td>
        <td><?php echo $collab->getName() ?></td>
        <td><?php echo $collab->getSurname() ?></td>
        <td><?php echo $collab->getMail() ?></td>
        <td><?php echo $collab->getCreationdate()->format("Y-m-d H:i:s") ?></td>
        <td><button type="submit" class="remove" value="<?php echo $collab->getId() ?>">Renvoyer</button></td>
    </tr>
<?php } 
?>
<script>
var removebuttons = document.getElementsByClassName("remove");
        for (var i = 0; i < removebuttons.length; i++) {
            removebuttons[i].addEventListener('click', function() {
                var iduser = this.value;
                //TODO ajouter une saisie lors de la selection
                $.get({
                    url: 'removefromorga.php',
                    data: {
                        iduser: iduser,
                        idorganization: <?php echo $org->getId(); ?>
                    },
                    success: refreshuser
                });
            });
        }
</script>
<?php ?>