<?php


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

use Db\Connection;
use Task\Task;
use Task\TaskHydrator;
use Task\TaskRepository;


if(isset($_POST['idproject']))
    $idproject = $_POST['idproject'];
else if(isset($_GET['idproject']))
    $idproject = $_GET['idproject'];

$taskrepository =
    new TaskRepository(Connection::get(), new TaskHydrator());

$tasksofproject = $taskrepository->fetchByProject($idproject);
/** @var Task $taskofproject */
foreach ($tasksofproject as $taskofproject) {?>
    <div>
        <label for="nametask"><? echo $taskofproject->getTitle(); ?> <? echo $taskofproject->getContent(); ?> </label>
        <input name="check-task-delete" type="checkbox" value data-idtask="<? echo $taskofproject->getId()?>">
    </div>
<? }?>
