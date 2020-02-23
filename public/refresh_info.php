<?php
use Db\Connection;
use Info\Info;
use Info\InfoHydrator;
use Info\InfoRepository;


require_once '../src/Bootstrap.php';

$infoRepository =
    new InfoRepository(Connection::get(), new InfoHydrator());

$infos = $infoRepository->fetchAll();

/** @var Info $info */
foreach ($infos as $info) {
    ?>
    <tr>
        <td> <?php echo $info->getTitle(); ?> </td>
        <td> <?php echo $info->getContent(); ?> </td>
    </tr>
    <?php
}
?>
