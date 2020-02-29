<?php

require_once '../src/Bootstrap.php';

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;

$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$id = !empty($_GET['id'])?$_GET['id']:null;

if($id)
{
    $userRepository->becomeAdmin($id);
}