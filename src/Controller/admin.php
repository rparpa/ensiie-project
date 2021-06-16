<?php
use Model\Article;
$conn = \Db\Connection::get();

switch ($_POST['to_do']) {
    case "removeDemandeModo":
        removeFromModaration($conn); break;
    case "removeArticle":
        removeArticle($conn); break;
    case "getArticleToValidate":
        Article::getArticleToValidate($conn); break;
    case "getDemandeModo":
        getDemandeModo($conn); break;
    case "validateModo":
        validateModo($conn); break;
    case "validateArticle":
        if (!isset($_POST['id_article'])){
            echo json_encode(array('status' => 'Error admin', 'msg' => 'A fields is not set :\'id_article\''));
            break;
        }
        Article::validateArticle($conn, $_POST['id_article']); break;
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']." in account.php\n", TRUE));
}

function getDemandeModo($conn) {

    $sql = 'SELECT * FROM public.User NATURAL JOIN public.Moderation ORDER BY USERNAME';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo json_encode(array('status' => 'Success', 'demande' => $result));
}


function validateModo($conn){
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error admin', 'msg' => 'A fields is not set :\'username\''));
        return;
    }
    $username = $_POST['username'];
    $sql = 'INSERT INTO public.Admin (USERNAME) VALUES (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    removeFromModaration($conn);
    updateUserAdmin($conn, $username);
}

function removeFromModaration($conn){
    if (!isset($_POST['username'])){
        echo json_encode(array('status' => 'Error admin', 'msg' => 'A fields is not set :\'username\''));
        return;
    }
    $username = $_POST['username'];
    $sql = 'DELETE FROM public.Moderation WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
}

function updateUserAdmin($conn, $username){
    $sql = 'UPDATE public.User SET VALIDATED = true WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
}

function removeArticle($conn){
    if (!isset($_POST['id_article'])){
        echo json_encode(array('status' => 'Error admin', 'msg' => 'A fields is not set :\'id_article\''));
        return;
    }

    $id = $_POST['id_article'];
    $sql = 'DELETE FROM public.Section WHERE ID_PAGE = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
   
    $sql = 'DELETE FROM public.Article  WHERE ID_PAGE = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
}