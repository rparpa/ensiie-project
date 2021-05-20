<?php
    $conn = \Db\Connection::get();

    switch($_POST['to_do']){
        case "check_password":
            if(isset($_POST['password']) and isset($_POST['username']))
                check_password($conn);
            else
                echo json_encode(array('status' => 'Error check Password', 'msg' => 'A fields is not set : \'password\' or \'username\''));
            break;
        case "change_password":
            if(isset($_POST['new_password']) and isset($_POST['username']))
                change_password($conn);
            else
                echo json_encode(array('status' => 'Error change Password', 'msg' => 'A fields is not set : \'password\' or \'username\''));
            break;
    }

    function check_password($conn) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = 'SELECT PASSWD FROM public.User WHERE username = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        if($result == 1){
            $row = $stmt->fetch();
            if(password_verify($password, $row["PASSWD"]))
                echo json_encode(array('status' => 'success', 'value' => 'match', 'msg' => 'Passwords match'));
            else
                echo json_encode(array('status' => 'success', 'value' => 'no_match', 'msg' => 'Passwords do not match'));
        }
        else{
            echo json_encode(array('status' => 'error', 'msg' => 'ERROR SERVER user not found ! \'account.php\''));
        }
    }

    function change_password($conn) {
        $username = $_POST['username'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        $sql = 'UPDATE public.User SET passwd = ? WHERE username = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $new_password);
        $stmt->bindParam(2, $username);
        $stmt->execute();
        $result = $stmt->rowCount();
        if($result == 1){
            echo json_encode(array('status' => 'success', 'msg' => 'Password updated'));
        }
        else{
            echo json_encode(array('status' => 'error', 'msg' => 'Error during database update'));
        }
    }

?>