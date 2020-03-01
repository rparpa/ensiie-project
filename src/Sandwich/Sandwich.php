<?php
namespace Sandwich;

class Sandwich
{
    /**
     * @var int
     */
    private ?int $id = null;

    /**
     * @var string
     */
    private string $label;

    /**
     * @var array
     */
    private ?array $ingredients = null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Sandwich
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Sandwich
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * @return array of Ingredient
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param array of Ingredient $ingredient
     * @return Sandwich
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }
}
