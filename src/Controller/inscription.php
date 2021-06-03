<?php

use Db\Connection;
use \Model\User;

$conn = Connection::get();

file_put_contents('php://stderr', print_r($_POST, TRUE));


switch ($_POST['to_do']) {
    case "check_username":
        checkUsername($conn);
        break;
    case "inscription":
        inscription($conn);
        break;
    case "check_email":
        checkEmail($conn);
        break;
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']."\n", TRUE));
}


function checkUsername($conn){
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error check Username', 'msg' => 'A fields is not set : \'username\''));
        return;
    }
    $nb = User::checkUsername($_POST['username'], $conn);
    if($nb == 0) {
        echo json_encode(array('status' => 'success', 'msg' => 'Username not Used'));
    }
    else{
        echo json_encode(array('status' => 'error', 'msg' => 'Username already Used'));
    }
}

function checkEmail($conn){
    if (!isset($_POST['email'])){
        echo json_encode(array('status' => 'Error check email', 'msg' => 'A fields is not set : \'email\''));
        return;
    }
    $nb = User::emailExist($_POST['email'], $conn);
    if ($nb == 0) {
        file_put_contents('php://stderr', print_r("My is not set\n", TRUE));
        echo json_encode(array('status' => 'success', 'msg' => 'Email not Used'));
    }
    else {
        echo json_encode(array('status' => 'error', 'msg' => 'Email already Used'));
    }
}

function inscription($conn){
    if( !(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])) ){
        echo json_encode(array('status' => 'Error inscription', 'msg' => 'One of this fields is not set : \'username\', \'email\' or \'password\''));
        return;
    }
    $username = $_POST['username'];
    $result = User::createUser($username, $_POST['email'], $_POST['password'], $conn);
    if ($result) {
        echo json_encode(array('status' => 'success', 'msg' => 'User \'' . $username . '\' added in database'));
    }
    else{
        echo json_encode(array('status' => 'error', 'msg' => 'Insertion in database failed'));
    }
}

?>