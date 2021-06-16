<?php
$conn = \Db\Connection::get();

switch ($_POST['to_do']) {
    case "checkPassword":
        checkPassword($conn); break;
    case "changePassword":
        changePassword($conn); break;
    case "userInfo":
        getUserInfo($conn); break;
    case "changeEmail":
        changeEmail($conn); break;
    case "deleteUser":
        deleteUser($conn); break;
    case "demandeModo":
        demandeModo($conn); break;
    case "checkModo":
        checkModo($conn); break;
        
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']." in account.php\n", TRUE));
}

function checkModo($conn){
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error get username', 'msg' => 'A fields is not set :\'username\' '));
        return;
    }

    $username = $_POST['username'];
    $sql = 'SELECT * FROM public.Moderation WHERE USERNAME = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    if($stmt->rowCount() >= 1)
        echo json_encode(array('status' => 'Success', 'data' => 'true'));
    else
        echo json_encode(array('status' => 'Success', 'data' => 'false'));
}

function demandeModo($conn){
    if (!isset($_POST['username']) || !isset($_POST['msg'])){
        echo json_encode(array('status' => 'Error get username or msg', 'msg' => 'A fields is not set :\'username\' or \'msg\''));
        return;
    }

    $username = $_POST['username'];
    $msg = $_POST['msg'];
    $sql = 'INSERT INTO public.Moderation (USERNAME, MSG) VALUES (?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $msg);
    $stmt->execute();
    echo json_encode(array('status' => 'Success'));
}

function getUserInfo($conn) {
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error get user information Password', 'msg' => 'A fields is not set :\'username\''));
        return;
    }

    $username = $_POST['username'];
    $sql = 'SELECT EMAIL FROM public.User WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        $row = $stmt->fetch();
        echo json_encode(array('status' => 'success', 'msg' => 'User found', 'email' => $row['email']));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'ERROR SERVER user not found ! \'account.php\''));
    }
}

function checkPassword($conn)
{
    if (!isset($_POST['password']) or !isset($_POST['username'])){
        echo json_encode(array('status' => 'Error check Password', 'msg' => 'A fields is not set : \'password\' or \'username\''));
        return;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT PASSWD FROM public.User WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        $row = $stmt->fetch();
        if (password_verify($password, $row['passwd']))
            echo json_encode(array('status' => 'success', 'value' => 'match', 'msg' => 'Passwords match'));
        else
            echo json_encode(array('status' => 'unsuccess', 'value' => 'no_match', 'msg' => 'Passwords do not match'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'ERROR SERVER user not found ! \'account.php\''));
    }
}

function changePassword($conn)
{
    if (!isset($_POST['new_password']) or !isset($_POST['username'])){
        echo json_encode(array('status' => 'Error change Password', 'msg' => 'A fields is not set : \'new_password\' or \'username\''));
        return;
    }
    
    $username = $_POST['username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $sql = 'UPDATE public.User SET passwd = ? WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $new_password);
    $stmt->bindParam(2, $username);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        echo json_encode(array('status' => 'success', 'msg' => 'Password updated'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Error during database update (Password)'));
    }
}

function changeEmail($conn){
    if (!isset($_POST['username']) or !isset($_POST['new_email'])){
        echo json_encode(array('status' => 'Error change Email', 'msg' => 'A fields is not set :\'username\' or \'email\''));
        return;
    }

    $username = $_POST['username'];
    $new_email = $_POST['new_email'];
    $sql = 'UPDATE public.User SET email = ? WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $new_email);
    $stmt->bindParam(2, $username);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        echo json_encode(array('status' => 'success', 'msg' => 'Email updated'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Error during database update (Email)'));
    }
}

function deleteUser($conn){
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error delete user', 'msg' => 'A fields is not set :\'username\''));
        return;
    }

    $username = $_POST['username'];
    $sql = 'DELETE FROM public.User WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        echo json_encode(array('status' => 'success', 'msg' => 'User \''.$username.'\' delete'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Error during database delete'));
    }
}