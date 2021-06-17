<?php
namespace Model;

use PDO;

class NewCategory{
    private PDO $pdo;
    private string $name;

    public function __construct($pdo, $name){
        $this->pdo = $pdo;
        $this->name = $name;
    }
    public function insertDatabase(){
        $sql = "INSERT INTO public.NewCategory (NAME) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
    }
    public function deleteDatabase(){
        $sql = "DELETE FROM public.NewCategory WHERE name = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
    }

    public static function getAll($pdo){
        $sql = 'SELECT * FROM public.NewCategory';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}