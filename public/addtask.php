<?php

use Db\Connection;
use Project\ProjectHydrator;
use Project\ProjectRepository;
use Task\TaskHydrator;
use Task\TaskRepository;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$title = !empty($_GET['title']) ? $_GET['title'] : null;;
$content = !empty($_GET['content']) ? $_GET['content'] : null;;
$state = !empty($_GET['state']) ? $_GET['state'] : null;;
$idcreator = !empty($_GET['idcreator']) ? $_GET['idcreator'] : null;;
$idassignee = !empty($_GET['idassignee']) ? $_GET['idassignee'] : null;;
$idproject = !empty($_GET['idproject']) ? $_GET['idproject'] : null;;

$taskrepository =
    new TaskRepository(Connection::get(), new TaskHydrator());
$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());
$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());


if(null!==$title && null!==$content && null!==$state &&
    null!==$idcreator && null!==$idassignee && null!==$idproject){
    $taskrepository->insert(
        $userrepository->findOneById($idcreator),
        $userrepository->findOneById($idassignee),
        $projectrepository->findOneById($idproject),
        $title,$content,$state,
        new \DateTimeImmutable("now"));
}
