<?php

use Db\Connection;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';

if(!isset($_SESSION["user_id"]))
    header('Location: index.php');


$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$authenticatorService = new AuthenticatorService($userRepository,$userHydrator);

$data = [
    'user' => $authenticatorService->getCurrentUser()
];

include_once '../src/View/template.php';
loadView('user',$data);

