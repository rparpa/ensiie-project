<?php


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use User\User;
use User\UserHydrator;
use User\UserRepository;


if(isset($_POST['idproject']))
    $idproject = $_POST['idproject'];
else if(isset($_GET['idproject']))
    $idproject = $_GET['idproject'];

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

$usersoforganization = $userrepository->fetchByOrganizationNotInProject($idproject);
foreach ($usersoforganization as $useroforganization) {
    /** @var User $user */
    $user = ((Object)$useroforganization)->user;
    ?>
<option data-id="<? echo $user->getId();?>"><? echo $user->getName()?></option>
<? }?>
