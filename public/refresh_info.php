<?php

use Db\Connection;
use Info\Info;
use Info\InfoHydrator;
use Info\InfoRepository;
use User\UserHydrator;
use User\UserRepository;


require_once '../src/Bootstrap.php';

$infoRepository =
    new InfoRepository(Connection::get(), new InfoHydrator());
$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$infos = $infoRepository->fetchAll();

/** @var Info $info */
foreach ($infos as $info) {
?>
    <h2 class="infotext"><?php echo $info->getTitle(); ?></h2>
    <h3 class="infotext"><?php echo $info->getContent(); ?></h3>
    <h5 class="infotext">Par <?php echo $userRepository->findOneById($info->getIdcreator())->getUsername(); ?> le <?php echo $info->getCreationdate()->format("Y-m-d"); ?></h5>
    <br>
<?php
}
?>