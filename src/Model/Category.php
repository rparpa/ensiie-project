<?php

namespace Model;

class Category{

    public static function getAll($pdo){
        $sql = "SELECT name FROM Category";;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();;
    }
}
?>