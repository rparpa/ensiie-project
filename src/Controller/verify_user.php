<?php
$pdo = \Db\Connection::get();

$username = $_POST['username'];
$pwd = $_POST['pwd'];

$sql = 'SELECT passwd FROM public.User WHERE username = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $username);
$stmt->execute();

$result = $stmt->fetch();

$status = "";
$msg = "";

if(password_verify($pwd, $result['passwd'])){
    $status = "success";
    $msg = "Bienvenue_".$username."!";
}
else{
    $status = "error";
    $msg = "Mauvais mot de passe !";
}


echo json_encode(array('status' => $status, 'msg' => $msg));
?>