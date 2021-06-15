<?php
namespace Model;

use DateTimeInterface;
use PDO;

use \Model\Section;

class Article{

    private $pdo;

    private $id;
    private $title;
    private $creationDate;
    private $modificationDate;
    private $validated;
    private $synopsis;
    private $idAdmin;
    private $cat0;
    private $cat1;
    private $sections;    

    public function __construct($pdo){
        $this->pdo = $pdo; 
    }

    public static function fromDict($pdo, $dict){
        $article = new Article($pdo);
        $article->title = $dict['title'];
        $article->synopsis = $dict['synopsis'];
        $article->cat0 = $dict['cat0'];
        $article->cat1 = $dict['cat1'];
        $article->sections = $dict['sections'];
        $article->creationDate = date("Y-m-d");
        $article->modificationDate = date("Y-m-d");
        $article->validated = False;
        $article->idAdmin = -1;
        return $article;
    }

    public function createArticle(){
        $sql = "INSERT INTO public.Article 
            (TITLE, CREATION_DATE, MODIFICATION_DATE, VALIDATED, SYNOPSIS, ID_ADMIN, CAT0, CAT1) 
            VALUES (?, ?, ?, FALSE, ?, 1, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->creationDate);
        $stmt->bindParam(3, $this->modificationDate);
        $stmt->bindParam(4, $this->synopsis);
        $stmt->bindParam(5, $this->cat0);
        $stmt->bindParam(6, $this->cat1);
 
        $stmt->execute();
        $id = $this->pdo->lastInsertId();
        
        foreach($this->sections as $k => $v){
            $sect = new Section($this->pdo, $id, $v['title'], $v['content']);
            $sect->insertDatabase();
        }
    }

    public static function exist($pdo, $value){
        $sql = 'SELECT * FROM Article WHERE title = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $value);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public static function getAll($conn) {
        $sql = 'SELECT * FROM public.Article ORDER BY ID_PAGE';
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
                $row = $stmt->fetchAll();
                echo json_encode($row);
        }
        else {
            echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de recharger la page.'));
        }
    }
    
    public static function getArticle($conn, $id){
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
    
    
        $sql = 'SELECT * FROM public.Section WHERE ID_PAGE = ? ORDER BY ID_SECTION';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        if ($stmt->execute()) {
            $sections = $stmt->fetchAll();
            echo json_encode(array('page' => $page, 'sections' => $sections));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'Une erreur est survenu, merci de retourner a la page d\'accueil.'));
        }
    }

    public static function getArticleToValidate($pdo){
        $sql = 'SELECT * FROM public.Article WHERE VALIDATED = FALSE ORDER BY ID_PAGE';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode(array('status' => 'Success', 'articles' => $result));
    }

    public static function validateArticle($pdo, $id){
        $sql = 'UPDATE public.Article SET VALIDATED = TRUE WHERE ID_PAGE = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}

?>