<?php
namespace Model;

use PDO;

class Section{

    private $pdo;

    private int $id;
    private string $title;
    private string $content;
    private int $pageId;

    public function __construct($pdo, $id, $pageId, $title, $content){
        $this->pdo = $pdo;
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->pageId = $pageId;
    }

    public function insertDatabase(){
        $sql = "INSERT INTO Section (TITLE, CONTENT, ID_PAGE) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->content);
        $stmt->bindParam(3, $this->pageId);
        $stmt->execute();

        $this->id = $this->pdo->lastInsertId();
    }

    public function updateSection(){
        $sql = "UPDATE public.Section
                SET title = ?, content = ?
                WHERE id_page = ?
                AND id_section = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->content);
        $stmt->bindParam(3, $this->pageId);
        $stmt->bindParam(4, $this->id);
        $stmt->execute();
    }

    public function removeSection(){
        $sql = "DELETE FROM public.Section
                WHERE id_section = ?
                AND id_page = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($this->id, $this->pageId));

        $article = new Article($this->pdo);
        $article->setId($this->pageId);
        $article->updateArticleDate();

    }

    public function getId(){ return $this->id; }
    public function getTitle(){ return $this->title; }
    public function getContent(){ return $this->content; }
    public function getPageId(){ return $this->pageId; }
    

}


?>