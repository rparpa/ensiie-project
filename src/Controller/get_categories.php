<?php
use \Model\Category;
use \Db\Connection;

$pdo = Connection::get();

switch ($_POST['to_do']) {
    case "getAll":
        $result = Category::getAll($pdo);
        echo json_encode(array('status' => "success", 'categories' => $result)); break;
    case "get_by_cat":
        if (isset($_POST['cat'])){
            $result = Category::getByName($pdo, $_POST["cat"]);
            echo json_encode(array('status' => "success", 'articles' => $result));
            break;
        }
    default:
        file_put_contents('php://stderr', print_r("Unknown action 'to_do':".$_POST['to_do']." in get_categories.php\n", TRUE));
}  
?>