<?php

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use User\UserHydrator;
use User\UserRepository;


$messageRepository =
    new MessageRepository(Connection::get(), new MessageHydrator());

$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$orgarepository = new OrganizationRepository(Connection::get(), new OrganizationHydrator());

$pseudo =  !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$message =  !empty($_POST['message']) ? $_POST['message'] : null;

$source = new Chat();

if (null != $pseudo && null != $message) {
    $user = $userRepository->findOneByUsername($pseudo);

    $userorga = $orgarepository->fetchByUser($user->getId());
    if($userorga)
        $source = ((Object)$userorga)->organization;


    $messageRepository->insert($user, $source, $message, new \DateTimeImmutable("now"));
}
header("location:" . $_SERVER['HTTP_REFERER']);