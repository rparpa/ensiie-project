<?php
namespace Ingredient;

class Ingredient
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
     * @var bool
     */
    private ?bool $available = true;

    /**
     * @var float
     */
    private ?float $price = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Ingredient
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
     * @return Ingredient
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param bool $available
     * @return Ingredient
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getPrice()
    {
        if (0 > $this->price) {
            throw new \OutOfRangeException('Price must be positive');
        }

        return $this->price;
    }

    /**
     * @param float $price
     * @return Ingredient
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}
