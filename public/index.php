<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';

$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$users = $userRepository->fetchAll();

$data = [
    'users' => $users
];

include_once '../src/View/template.php';
loadView('home', $data);


