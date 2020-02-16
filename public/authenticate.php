<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);


$email =  !empty($_POST['email']) ? $_POST['email'] : null;
$password =  !empty($_POST['password']) ? $_POST['password'] : null;

$viewData = [];
if (null !== $email && null !== $password) {
  $user = $userRepository->findOneByMail($email);
  if (null !== $user && $password==$user->getPassword()) {
      session_start();
      $_SESSION['user_id'] = $user->getId();
      header('Location: index.php');
      exit;
  }
  $viewData['failedAuthent'] = 'Authentication failed';
  loadView('login', $viewData);
  
}