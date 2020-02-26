<?php

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use User\User;
use User\UserHydrator;
use User\UserRepository;

$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$collabs = $userRepository->fetchByOrganization($authenticatorService->getCurrentUserId());
foreach ($collabs as $collab) {
    /** @var User $collab */
    $collab = ((object) $collab)->user ?>
    <tr onclick="ShowAlert()" name="<?php echo $collab->getId() ?>">
        <th scope="row"><?php echo $collab->getId() ?></th>
        <td><?php echo $collab->getUsername() ?></td>
        <td><?php echo $collab->getName() ?></td>
        <td><?php echo $collab->getSurname() ?></td>
        <td><?php echo $collab->getMail() ?></td>
        <td><?php echo $collab->getCreationdate()->format("Y-m-d H:i:s") ?></td>
    </tr>
<?php } ?>