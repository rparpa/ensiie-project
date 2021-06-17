<?php
namespace Model;

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

    public function __construct(PDO $pdo){
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
        $this->id = $this->pdo->lastInsertId();
        
        foreach($this->sections as $k => $v){
            $sect = new Section($this->pdo, 0, $this->id, $v['title'], $v['content']);
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

    public static function getArticleObject($pdo, $id){
        $sql = 'SELECT * FROM public.Article WHERE ID_PAGE = ?' ;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if($stmt->rowCount() != 1){
            return;
        }
        $obj = $stmt->fetch(PDO::FETCH_OBJ);
        $article = new Article($pdo);

        $article
                ->setId($obj->id_page)
                ->setTitle($obj->title)
                ->setCreationDate($obj->creation_date)
                ->setModificationDate($obj->modification_date)
                ->setValidated($obj->validated)
                ->setSynopsis($obj->synopsis)
                ->setIdAdmin($obj->id_admin)
                ->setCat0($obj->cat0)
                ->setCat1($obj->cat1);

        $article->fetchSections();
        return $article;
    }

    public function fetchSections(){
        $sql = 'SELECT * FROM public.Section WHERE ID_PAGE = ? ORDER By id_section';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $this->sections = [];
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $section = new Section($this->pdo, $row->id_section, $row->id_section, $row->title, $row->content);
            $this->sections[] = $section;
        }
    }

    public function updateArticle(){
        $sql = 'UPDATE public.Article 
                SET synopsis = ?, modification_date = ?, validated = False
                WHERE id_page = ?';
        $stmt = $this->pdo->prepare($sql);
        
        $date = date("Y-m-d");
        $stmt->bindParam(1, $this->synopsis);
        $stmt->bindParam(2, $date);
        $stmt->bindParam(3, $this->id);
        $stmt->execute();
    }

    public function updateArticleDate(){
        $sql = "UPDATE public.Article 
                SET modification_date = ?, validated = False
                WHERE id_page = ?";
        $stmt = $this->pdo->prepare($sql);
        $date = date("Y-m-d");
        $stmt->bindParam(1, $date); 
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }

    public function setId($id){ $this->id = $id; return $this; }
    public function setTitle($title){ $this->title = $title; return $this; }
    public function setCreationDate($creationDate){ $this->creationDate = $creationDate; return $this; }
    public function setModificationDate($modificationDate){ $this->modificationDate = $modificationDate; return $this; }
    public function setValidated($validated){ $this->validated = $validated; return $this; }
    public function setSynopsis($synopsis){ $this->synopsis = $synopsis; return $this; }
    public function setIdAdmin($idAdmin){ $this->idAdmin = $idAdmin == NULL ? 0 : $idAdmin; return $this; }
    public function setCat0($cat0){ $this->cat0 = $cat0; return $this; }
    public function setCat1($cat1){ $this->cat1 = $cat1; return $this; }

    public function getId(){ return $this->id; }
    public function getTitle(){ return $this->title; }
    public function getCreationDate(){ return $this->creationDate; }
    public function getModificationDate(){ return $this->modificationDate; }
    public function getValidated(){ return $this->validated; }
    public function getSynopsis(){ return $this->synopsis; }
    public function getIdAdmin(){ return $this->idAdmin; }
    public function getCat0(){ return $this->cat0; }
    public function getCat1(){ return $this->cat1; }
    public function getSections(){ return $this->sections; }

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

    public static function getTitles($pdo){
        $sql = 'SELECT TITLE FROM public.Article ORDER BY TITLE';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode(array('status' => 'Success', 'titles' => $result));
    }

    public static function getArticleByTitle($pdo, $title){
        $sql = 'SELECT * FROM public.Article WHERE TITLE LIKE ? ORDER BY TITLE';
        $stmt = $pdo->prepare($sql);
        $u = "%".$title."%";
        $stmt->bindParam(1, $u);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo json_encode(array('status' => 'Success', 'articles' => $result));
    }
}

?>