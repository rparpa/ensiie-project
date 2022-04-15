<?php

namespace Db;

use models\Category;
use PDO;

class CategoryManager extends Manager
{
    /**
     * Récupère toutes les catégories contenues dans la base de données ordonnées par le nom
     * @return array la liste de toutes les catégories
     */
    public function findAll(): array
    {
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_category ORDER BY ca_name ASC');
        return $this->convertRowsToCategoriesArray($pdoStatement->fetchAll());
    }

    /**
     * Récupère la catégorie qui a la clé primaire passée en paramètre
     * @param $id
     * @return Category|null
     */
    public function findById($id): ?Category
    {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM tc_category WHERE ca_id=:id');
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $execute = $pdoStatement->execute();
        $category = null;
        if ($execute) {
            $db_row = $pdoStatement->fetch();
            if ($db_row !== false) {
                $category = new Category($db_row[0], $db_row[1], $db_row[2]);
            }
        }
        return $category;
    }

    public function create($category): ?Category
    {
        $categoryCreated = null;
        if ($category instanceof Category) {
            $pdoManagement = $this->pdo->prepare('INSERT INTO tc_category(ca_name) VALUES (:name)');
            $pdoManagement->bindValue(':name', $category->getName());
            $isSuccess = $pdoManagement->execute();
            if ($isSuccess) {
                $categoryCreated = $this->findById($this->pdo->lastInsertId());
            }
        }
        return $categoryCreated;
    }

    public function update($object): ?Category
    {
        $categoryUpdated = null;
        if ($object instanceof Category) {
            $currentCategory = $this->findById($object->getId());
            if ($currentCategory != null) {
                $currentCategory->setName($object->getName());
                $pdoManagement = $this->pdo->prepare('UPDATE tc_category SET ca_name=:name WHERE ca_id=:id');
                $pdoManagement->bindValue(':name', $currentCategory->getName());
                $pdoManagement->bindValue(':id', $currentCategory->getId());
                $isSuccess = $pdoManagement->execute();
                if ($isSuccess) {
                    $categoryUpdated = $this->findById($currentCategory->getId());
                }
            }
        }
        return $categoryUpdated;
    }

    /**
     * IL est impossible de supprimer une catégorie
     * @param $object
     * @return false
     */
    public function delete($object): bool
    {
        return false;
    }


    /**
     * Récupère la liste des 5 premières catégories selon le nombre de trocs les concernant
     * @return array la liste de toutes les catégories
     */
    public function findAllOrderByNumberSwapTop5(): array
    {
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_category ORDER BY ca_number_swap DESC LIMIT 5');
        return $this->convertRowsToCategoriesArray($pdoStatement->fetchAll());
    }

    private function convertRowsToCategoriesArray($dbarray): array
    {
        $categories = [];
        foreach ($dbarray as $db_row) {
            $categories[] = new Category($db_row[0], $db_row[1], $db_row[2]);
        }
        return $categories;
    }

}