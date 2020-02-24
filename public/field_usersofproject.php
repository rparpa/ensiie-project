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

$usersofproject = $userrepository->fetchByProject($idproject);
foreach ($usersofproject as $userofproject) {
    /** @var User $user */
    $user = ((Object)$userofproject)->user;?>
    <div>
        <label for="nameuser"><? echo $user->getSurname(); ?> <? echo $user->getName(); ?> </label>
        <input name="check-user-delete" type="checkbox" value data-iduser="<? echo $user->getId()?>">
    </div>
<? }?>
