<?php


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use Meeting\Meeting;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;


if(isset($_POST['idproject']))
    $idproject = $_POST['idproject'];
else if(isset($_GET['idproject']))
    $idproject = $_GET['idproject'];

$meetingrepository =
    new MeetingRepository(Connection::get(), new MeetingHydrator());

$meetingsofproject = $meetingrepository->fetchByProject($idproject);

/** @var Meeting $meeting */
foreach ($meetingsofproject as $meeting) {?>
    <div>
        <label for="namemeeting"><? echo $meeting->getName(); ?> <? echo $meeting->getDescription(); ?> </label>
        <input name="check-meeting-delete" type="checkbox" value data-idmeeting="<? echo $meeting->getId()?>">
    </div>
<? }?>
