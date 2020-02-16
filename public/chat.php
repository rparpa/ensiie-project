<?php

require_once '../src/Bootstrap.php';

use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;

include_once '../src/View/template.php';

$messageHydrator = new MessageHydrator();
$messageRepository =
    new MessageRepository(Connection::get(), $messageHydrator);


$pseudo =  !empty($_POST['pseudo']) ? $_POST['pseudo'] : null;
$message =  !empty($_POST['message']) ? $_POST['message'] : null;

if (null != $pseudo && null != $message) {
    //TODO a finaliser
    //$messageRepository->insert();
}