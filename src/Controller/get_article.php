<?php

use Db\Connection;

$conn = Connection::get();

switch ($_POST['to_do']) {
    case "get_all":
        get_all($conn); break;
    case "get_article":
        get_article($conn); break;
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']." in get_article.php\n", TRUE));
}

function get_all($conn) {
    $sql = 'SELECT * FROM public.Article';
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
            $row = $stmt->fetchAll();
            echo json_encode($row);
    }
    else {
        echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de recharger la page.'));
    }
}

function get_article($conn){
    if (!isset($_POST['id_article'])){
        echo json_encode(array('status' => 'Error get article id', 'msg' => 'A fields is not set :\'id_article\''));
        return;
    }

    $id = $_POST['id_article'];

    $sql = 'SELECT * FROM public.Article WHERE ID_PAGE = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result == 1) {
        $page = $stmt->fetch();
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de retourner a la page d\'accueil.'));
    }


    $sql = 'SELECT * FROM public.Section WHERE ID_PAGE = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->rowCount();
    
    if ($stmt->execute()) {
        $sections = $stmt->fetchAll();
        echo json_encode(array('page' => $page, 'sections' => $sections));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de retourner a la page d\'accueil.'));
    }
}
?>