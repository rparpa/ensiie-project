<?php
namespace Ingredient;
use PDO;

class IngredientRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query(
            'SELECT * FROM "ingredient"')
            ->fetchAll(PDO::FETCH_OBJ);
            
        $ingredients = [];
        foreach ($rows as $row) {
            $ingredient = new Ingredient();
            $ingredient
                ->setId($row->id)
                ->setLabel($row->label)
                ->setAvailable($row->available)
                ->setPrice($row->price);

            $ingredients[] = $ingredient;
        }

        return $ingredients;
    }

    public function findOneById($ingredientId)
    {        
        $query = $this->connection->prepare(
            'SELECT * FROM "user" WHERE id = :id');
        
        $query->bindValue(':id', $ingredientId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $ingredient = new Ingredient();

        $row ? $ingredient
            ->setId($row->id)
            ->setLabel($row->label)
            ->setAvailable($row->available)
            ->setPrice($row->price)
            : null;

        return $ingredient;
    }

    public function updateIngredient(Ingredient $ingredient)
    {
        $query = $this->connection->prepare(
            'UPDATE "ingredient" 
            SET id = :id,
                label = :label,
                available = :available,
                price = :price');

        $query->bindValue(':id', $ingredient->getId());
        $query->bindValue(':label', $ingredient->getLabel());
        $query->bindValue(':available', $ingredient->getAvailable());
        $query->bindValue(':price', $ingredient->getPrice());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    public function createIngredient(Ingredient $newIngredient)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "ingredient"(label, available, price) VALUES (:label , :available, :price)');
        
        $query->bindValue(':label', $newIngredient->getLabel());
        $query->bindValue(':available', $newIngredient->getAvailable());
        $query->bindValue(':price', $newIngredient->getPrice());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    public function deleteIngredient(Ingredient $ingredientToDelete)
    {
        $query = $this->connection->prepare('DELETE FROM "user" WHERE id = :id');
        $query->bindValue(':id', $ingredientToDelete->getId());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $result;
    }
}
