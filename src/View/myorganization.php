<?php

use Db\Connection;
use Organization\Organization;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Service\AuthenticatorService;

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Connection::get(),$orgahydrator);
$authenticatorService = new AuthenticatorService($userRepository);

$hide = true;


$myorgas = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());

$myorga = (object)$myorgas[0];

?>
<h1>
    Vous etes sur la page de l'organisation <?php echo $myorga->organization->getName() ?>
</h1>
<span>
    Salut <?php echo ((object)$myorgas[0])->role ?>
</span>
