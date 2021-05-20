<?php

use \Model\User;

$pdo = \Db\Connection::get();

$username = $_POST['username'];

$exist = User::verifyPassword($username, $_POST['pwd'], $pdo);
if($exist){
    $status = "success";
    $msg = "Bienvenue ".$username." !";
    $isadmin = User::userIsAdmin($username, $pdo);
}
else{
    $status = "error";
    $msg = "Mauvais mot de passe !";
    $isadmin = null;
}

echo json_encode(array('status' => $status, 'msg' => $msg, 'isadmin' => $isadmin));
?>