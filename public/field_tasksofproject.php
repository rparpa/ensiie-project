<?php


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use Task\TaskHydrator;
use Task\TaskRepository;


if(isset($_POST['idproject']))
    $idproject = $_POST['idproject'];
else if(isset($_GET['idproject']))
    $idproject = $_GET['idproject'];

$taskrepository =
    new TaskRepository(Connection::get(), new TaskHydrator());

$tasksofproject = $taskrepository->fetchByProject($idproject);
foreach ($tasksofproject as $taskofproject) {
    /** @var Task $task */
    $task = ((Object)$taskofproject)->task;?>
    <div>
        <label for="nametask"><? echo $task->getTitle(); ?> <? echo $task->getContent(); ?> </label>
        <input type="checkbox" value data-iduser="<? $task->getId()?>">
    </div>
<? }?>
