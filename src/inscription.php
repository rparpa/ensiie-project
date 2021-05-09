<?php
    
    date_default_timezone_set('UTC');


    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    $conn = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    switch($_POST['to_do']){
        case "check_username":
            if(isset($_POST['username']))
                check_username($conn);
            else
                echo json_encode(array('status' => 'Error check Username', 'msg' => 'A fields is not set : \'username\''));
            break;
        case "inscription":
            if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']))
                inscription($conn);
            else
                echo json_encode(array('status' => 'Error inscription', 'msg' => 'One of this fields is not set : \'username\', \'email\' or \'password\''));
            break;
        case "check_email":
            if(isset($_POST['email']))
                check_email($conn);
        else
            echo json_encode(array('status' => 'Error check email', 'msg' => 'A fields is not set : \'email\''));
        break;
    }

    function check_username($conn) {
        $username = $_POST['username'];
        $sql = 'SELECT * FROM public.User WHERE username = ?'; //
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        if($result < 1){
            echo json_encode(array('status' => 'success', 'msg' => 'Username not Used'));
        }
        else{
            echo json_encode(array('status' => 'error', 'msg' => 'Username already Used'));
        }
    }

    function check_email($conn) {
        $email = $_POST['email'];
        $sql = 'SELECT * FROM public.User WHERE email = ?'; //
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        if($result < 1){
            echo json_encode(array('status' => 'success', 'msg' => 'Email not Used'));
        }
        else{
            echo json_encode(array('status' => 'error', 'msg' => 'Email already Used'));
        }
    } 

    function inscription($conn){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $date = date('Y-m-d', time());
        $sql = 'INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES (?, ?, ?, ?, TRUE)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $passwd);
        $stmt->bindParam(4, $date);
        $stmt->execute();
        $result = $stmt->rowCount();

        if($result == 1){
            echo json_encode(array('status' => 'success', 'msg' => 'User \''.$username.'\' added in database'));
        }
        else{
            echo json_encode(array('status' => 'error', 'msg' => 'Insertion in database failed'));
        }
    }
?>