<?php

$pdo = \Db\Connection::get();

$username = $_POST['username'];

$exist = \Model\User::verifyPassword($username, $_POST['pwd'], $pdo);
if($exist){
    $status = "success";
    $msg = "Bienvenue ".$username." !";
}
else{
    $status = "error";
    $msg = "Mauvais mot de passe !";
}

echo json_encode(array('status' => $status, 'msg' => $msg));
?>