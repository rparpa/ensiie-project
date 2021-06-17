<?php

namespace Model;

use PDO;
class Category{
    private PDO $pdo;
    private string $name;

    public function __construct($pdo, $name){
        $this->pdo = $pdo;
        $this->name = $name;
    }
    public static function getAll($pdo){
        $sql = "SELECT name FROM Category";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertDatabase(){
        $sql = "INSERT INTO public.Category (NAME) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
    }

    public static function getByName($pdo, $name){
        if($name == "Aucune")
            $sql = "SELECT * FROM public.Article WHERE cat0 = ? AND cat1 = ? ORDER BY ID_PAGE";
        else
            $sql = "SELECT * FROM public.Article WHERE cat0 = ? OR cat1 = ? ORDER BY ID_PAGE";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>