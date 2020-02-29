<?php
namespace Sandwich;

use Ingredient\Ingredient;
use Ingredient\IngredientRepository;
use PDO;

class SandwichRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $rows = $this->connection->query(
            'SELECT * FROM "sandwich"')
            ->fetchAll(PDO::FETCH_OBJ);
            
        $sandwichs = [];
        foreach ($rows as $row) {
            $sandwich = new Sandwich();
            $sandwich
                ->setId($row->id)
                ->setLabel($row->label);

            $sandwichs[] = $sandwich;
        }

        foreach ($sandwichs as $sandwich) {
            $sandwich->setIngredients(
                $this->fetchIngredients($sandwich->getId())
            );
        }


        return $sandwichs;
    }

    public function findOneById($sandwichId)
    {        
        $query = $this->connection->prepare(
            'SELECT * FROM "sandwich" WHERE id = :id');
        
        $query->bindValue(':id', $sandwichId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $sandwich = new Sandwich();

        if($row) {
            $sandwich
                ->setId($row['id'])
                ->setLabel($row['label']);
            $sandwich
                ->setIngredients(
                $this->fetchIngredients($sandwich->getId())
            );
        } else {
            $sandwich = null;
        }

        return $sandwich;
    }

    public function createSandwich(Sandwich $newSandwich)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "sandwich"(label) VALUES (:label)');
        
        $query->bindValue(':label', $newSandwich->getLabel());

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        else
        {
            $newSandwich->setId($this->connection->lastInsertId());
            if( $newSandwich->getIngredients() != null )
            {
                foreach ($newSandwich->getIngredients() as $ingredient)
                {
                    $this->addIngredient($newSandwich->getId(), $ingredient->getId());
                }
            }
        }
        return $newSandwich;
    }

    public function deleteSandwich(Sandwich $sandwichToDelete)
    {
        $query = $this->connection->prepare('DELETE FROM "sandwich" WHERE id = :id');
        
        $query->bindValue(':id', $sandwichToDelete->getId());
        
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        else
        {
            if( $sandwichToDelete->getIngredients() != null)
            {
                foreach ($sandwichToDelete->getIngredients() as $ingredient)
                {
                    $this->removeIngredient($sandwichToDelete->getId(), $ingredient->getId());
                }
            }
        }

        return $result;
    }

    private function addIngredient($sandwichId, $ingredientId)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "sandwich_ingredient"(sandwich_id, ingredient_id) 
            VALUES (:sandwich_id, :ingredient_id)');
        
        $query->bindValue(':sandwich_id', $sandwichId);
        $query->bindValue(':ingredient_id', $ingredientId);

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    private function removeIngredient($sandwichId, $ingredientId)
    {
        $query = $this->connection->prepare(
            'DELETE 
            FROM "sandwich_ingredient" 
            WHERE sandwich_id = :sandwich_id 
            AND ingredient_id = :ingredient_id');
        
        $query->bindValue(':sandwich_id', $sandwichId);
        $query->bindValue(':ingredient_id', $ingredientId);

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    private function fetchIngredients($sandwichId)
    {
        $query = $this->connection->prepare(
            'SELECT sandwich_ingredient.ingredient_id AS id
            FROM sandwich_ingredient
            WHERE sandwich_ingredient.sandwich_id = :sandwichId');
        
        $query->bindValue(':sandwichId', $sandwichId, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);

        $ingredientRepository = new IngredientRepository($this->connection);

        $ingredients = [];
        foreach ($rows as $row) {
            $ingredient = new Ingredient();
            $ingredient = $ingredientRepository->findOneById($row->id);
            $ingredients[] = $ingredient;
        }

        return $ingredients;
    }
    /*
    private function fetchIngredients($sandwichId)
    {
        $query = $this->connection->prepare(
            'SELECT ingredient.id AS id,
             ingredient.label AS label,
             ingredient.available AS available,
             ingredient.price AS price
            FROM ingredient, sandwich_ingredient, sandwich
            WHERE sandwich.id = :sandwichId
            AND sandwich.id = sandwich_ingredient.sandwich_id
            AND sandwich_ingredient.ingredient_id = ingredient.id');
        
        $query->bindValue(':sandwichId', $sandwichId, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);

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
    }*/
}
