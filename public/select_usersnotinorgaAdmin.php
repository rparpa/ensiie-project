<?php


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use User\User;
use User\UserHydrator;
use User\UserRepository;

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());
 ?>

<select id="select-user-add" onchange="LoadFormualire()">
    <option></option>
    <?
    $usersnotinorg = $userrepository->fetchByOrganizationNotInOrga();

    foreach ($usersnotinorg as $usernotinorg) {
        /** @var User $user */
        $user = ((Object)$usernotinorg)->user;
        ?>
        <option
                data-id="<? echo $user->getId();?>"
                data-surname="<? echo $user->getSurname(); ?>"
                data-name="<? echo $user->getName()?>"
        ><? echo $user->getSurname() . ' ' . $user->getName()?>
        </option>
    <? } ?>
</select>
