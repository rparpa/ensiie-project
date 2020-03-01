<?php
namespace Ingredient;

/**
 * Class IngredientService
 * @package Ingredient
 */
class IngredientService
{

    private IngredientRepository $ingredientRepository;

    private ?array $errors = [];

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getAllIngredients() {
        $this->resetErrors();
        $ingredients = [];
        $ingredients = $this->ingredientRepository->fetchAll();
        return $ingredients;
    }

    public function getAvailableIngredients() {
        $this->resetErrors();
        $filteredIngredients = [];
        $ingredients = $this->ingredientRepository->fetchAll();
        foreach ($ingredients as $ingredient) {
            if($ingredient->getAvailable() == true) {
                    $filteredIngredients[] = $ingredient;
            }
        }

        return $filteredIngredients;
    }

    public function getIngredientById($ingredientId) {
        $this->resetErrors();
        $ingredient = null;
        if($ingredientId == null)
            $this->errors['id'] = 'Ingredient id shouldn\'t be null.';
        else if($ingredientId < 0)
            $this->errors['id'] = 'Ingredient id can\'t be inferior to zero.';
        else {
            $ingredient = $this->ingredientRepository->findOneById($ingredientId);
            if ($ingredient == null)
                $this->errors['id'] = 'Ingredient id ' . $ingredientId . ' doesn\'t exists.';
        }
        return $ingredient;
    }

    public function saveIngredient(Ingredient $ingredient) {
        $this->resetErrors();
        if($this->validateIngredient($ingredient))
        {
            if (null != $ingredient->getId())
                $ingredient = $this->ingredientRepository->updateIngredient($ingredient);
            else
                $ingredient = $this->ingredientRepository->createIngredient($ingredient);
        }
        return $ingredient;
    }

    public function deleteIngredient(Ingredient $ingredient) {
        $this->resetErrors();
        $result = false;
        if($ingredient->getId() == null)
            $this->errors['id'] = 'Ingredient id shouldn\'t be null.';
        else
            $result = $this->ingredientRepository->deleteIngredient($ingredient);
        return $result;
    }

    private function validateIngredient(Ingredient $ingredient) {
        $result = true;

        if (null == $ingredient->getLabel() || '' == $ingredient->getLabel() ) {
            $result = false;
            $this->errors['label'] = 'Label is mandatory.';

        } else if (null == $ingredient->getId()) {
            $existingIngredient = $this->ingredientRepository->findOneByLabel($ingredient->getLabel());
            if (null != $existingIngredient) {
                $result = false;
                $this->errors['label'] = 'This label already exists for an ingredient.';
            } 
        }

        if (null == $ingredient->getPrice() || 0 > $ingredient->getLabel() ) {
            $result = false;
            $this->errors['price'] = 'Price is mandatory and should be superior to zero..';
        }

        return $result;
    }

    private function resetErrors() {
        $this->errors = [];
    }
}