<?php
$conn = \Db\Connection::get();

switch ($_POST['to_do']) {
    case "check_password":
        if (isset($_POST['password']) and isset($_POST['username']))
            check_password($conn);
        else
            echo json_encode(array('status' => 'Error check Password', 'msg' => 'A fields is not set : \'password\' or \'username\''));
        break;
    case "change_password":
        if (isset($_POST['new_password']) and isset($_POST['username']))
            change_password($conn);
        else
            echo json_encode(array('status' => 'Error change Password', 'msg' => 'A fields is not set : \'new_password\' or \'username\''));
        break;
    case "user_info":
        if (isset($_POST['username']))
            get_user_info($conn);
    else
        echo json_encode(array('status' => 'Error get user information Password', 'msg' => 'A fields is not set :\'username\''));
    break;
    case "change_email":
        if (isset($_POST['username']) and isset($_POST['new_email']))
            change_email($conn);
    else
        echo json_encode(array('status' => 'Error change Email', 'msg' => 'A fields is not set :\'username\' or \'email\''));
    break;
    case "delete_user":
        if (isset($_POST['username']))
            delete_user($conn);
    else
        echo json_encode(array('status' => 'Error delete user', 'msg' => 'A fields is not set :\'username\''));
    break;
}

function get_user_info($conn) {
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

function check_password($conn)
{
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

function change_password($conn)
{
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

function change_email($conn){
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

function delete_user($conn){
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