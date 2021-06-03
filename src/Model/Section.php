<?php
namespace Model;

use PDO;

class Section{

    private PDO $pdo;

    private string $title;
    private string $content;
    private int $pageId;

    public function __construct($pdo, $pageId, $title, $content){
        $this->pdo = $pdo;
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
    }
}


?>