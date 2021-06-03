<?php

use Db\Connection;
use \Model\User;

$conn = Connection::get();

file_put_contents('php://stderr', print_r($_POST, TRUE));


function get_all($conn) {
    //if (!isset($_POST['username'])){
    //    echo json_encode(array('status' => 'Error get user information Password', 'msg' => 'A fields is not set :\'username\''));
    //    return;
    //}

    $sql = 'SELECT * FROM public.Article';
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        //$result = $stmt->rowCount();
        //for ($i = 0; $i < $result; $i++){
            $row = $stmt->fetchAll();
            echo json_encode($row);
        //}
    }
    else {
        echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de recharger la page.'));
    }
}

?>