<?php

require_once '../src/Bootstrap.php';

use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use User\UserHydrator;
use User\UserRepository;

include_once '../src/View/template.php';

$messageHydrator = new MessageHydrator();
$messageRepository =
    new MessageRepository(Connection::get(), $messageHydrator);

$userHydrator = new UserHydrator();
$userRepository =
    new UserRepository(Connection::get(), $userHydrator);

$pseudo =  !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$message =  !empty($_POST['message']) ? $_POST['message'] : null;

if (null != $pseudo && null != $message) {
    $user = $userRepository->findOneByUsername($pseudo);
    $messageRepository->insert($user,"chat",1,$message, new \DateTimeImmutable("now"));
}
header("location:" . $_SERVER['HTTP_REFERER']);