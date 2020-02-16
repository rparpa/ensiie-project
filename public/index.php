<?php

require_once '../src/Bootstrap.php';

$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository(\Db\Connection::get(), $userHydrator);
$users = $userRepository->fetchAll();

$data = [
    'users' => $users
];

include_once '../src/View/template.php';
loadView('home', $data);
?>

