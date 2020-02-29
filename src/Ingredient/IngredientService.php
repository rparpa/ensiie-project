<?php
namespace Ingredient;

/**
 * Class IngredientService
 * @package Ingredient
 */
class IngredientService
{
    /**
     * @var IngredientRepository
     */
    private IngredientRepository $ingredientRepository;

    /**
     * IngredientService constructor.
     * @param IngredientRepository $ingredientRepository
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getAllIngredients() {
        $ingredients = [];
        $ingredients = $this->ingredientRepository->fetchAll();
        return $ingredients;
    }

    public function getIngredientById($ingredientId) {
        //TODO if id == null set error
        //TODO if id < 0 set error
        $ingredient = $this->ingredientRepository->findOneById($ingredientId);
        return $ingredient;
    }

    public function saveIngredient(Ingredient $ingredient) {
        $this->validateIngredient($ingredient);

        if (null != $ingredient->getId()) {
            $ingredient = $this->ingredientRepository->updateIngredient($ingredient);
        } else {
            //TODO check if ingredient label is unique
            $ingredient = $this->ingredientRepository->createIngredient($ingredient);
        }
        return $ingredient;
    }

    public function deleteIngredient(Ingredient $ingredient) {
        $result = $this->ingredientRepository->deleteIngredient($ingredient);
        return $result;
    }

    private function validateIngredient(Ingredient $ingredient) {
        //TODO if label == null set error
        //TODO if label not unique set error

    }

}
