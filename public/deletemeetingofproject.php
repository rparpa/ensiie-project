<?php

use Db\Connection;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$meetingrepository =
    new MeetingRepository(Connection::get(),new MeetingHydrator());

$idmeeting =  !empty($_GET['idmeeting']) ? $_GET['idmeeting'] : null;

//TODO Il reste a sécuriser et controler les données avant insertion

if (null!==idmeeting){
    $meetingrepository->delete($idmeeting);
}


