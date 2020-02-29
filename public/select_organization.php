<?php

use Db\Connection;
use Organization\Organization;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

require_once '../src/Bootstrap.php';

$orgarepository = new OrganizationRepository(Connection::get(),new OrganizationHydrator());
$organizations = $orgarepository->fetchAll();

?>



<select id="select-organizations" onchange="showformSelect()">
    <option></option>
    <?php /** @var Organization $organization */
    foreach ($organizations as $organization) { ?>
        <option
                data-name="<?php echo $organization->getName() ?>"
                data-id=<?php echo $organization->getId() ?>
        ><?php echo $organization->getName() ?></option>
    <?php } ?>
</select>
