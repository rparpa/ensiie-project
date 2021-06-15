<?php

use Db\Connection;
use Model\Article;

$conn = Connection::get();

switch ($_POST['to_do']) {
    case "getAll":
        Article::getAll($conn); break;
    case "getArticle":
        if (!isset($_POST['id_article'])){
            echo json_encode(array('status' => 'Error get article id', 'msg' => 'A fields is not set :\'id_article\''));
            return;
        }
        Article::getArticle($conn, $_POST['id_article']); break;
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']." in getArticle.php\n", TRUE));
}
?>