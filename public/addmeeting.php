<?php

use Db\Connection;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$name = !empty($_GET['name']) ? $_GET['name'] : null;
$place = !empty($_GET['place']) ? $_GET['place'] : null;
$description = !empty($_GET['description']) ? $_GET['description'] : null;
$idsource = !empty($_GET['idsource']) ? $_GET['idsource'] : null;
$source = !empty($_GET['source']) ? $_GET['source'] : null;

$meetingrepository =
    new MeetingRepository(Connection::get(),new MeetingHydrator());

var_dump($_GET);


if(null!==$name && null!==$place && null!==$description &&
    null!==$idsource && null!==$source ){
    $meetingrepository->insert(
        $source,
        $idsource,
        $name,
        $place,
        $description,
        new \DateTimeImmutable("now"));
}
