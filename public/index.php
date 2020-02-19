<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;
use Service\AuthenticatorService;

require_once '../src/Bootstrap.php';


$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$users = $userRepository->fetchAll();
$authentificatorService = new AuthenticatorService($userRepository);

$data = [
    'users' => $users
];

$view = "home";

if ($authentificatorService->isAuthenticated()) {
    $view = "userhome";
}

include_once '../src/View/template.php';
loadView($view, $data);


