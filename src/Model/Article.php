<?php
namespace Model;

use DateTimeInterface;
use PDO;

use \Model\Section;

class Article{

    private PDO $pdo;

    private int $id;
    private string $title;
    private string $creationDate;
    private string $modificationDate;
    private bool $validated;
    private string $synopsis;
    private int $idAdmin;
    private string $cat0;
    private string $cat1;
    private array $sections;    

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

}

?>