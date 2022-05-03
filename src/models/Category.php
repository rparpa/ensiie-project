<?php

namespace models;

use ReturnTypeWillChange;

class Category
{
    public int $id;
    public string $name;
    public int $number_swap;

    function __construct_2($name)
    {
        $this->name = $name;
    }

    function __construct($id, $name, $number_swap)
    {
        $this->id = $id;
        $this->name = $name;
        $this->number_swap = $number_swap;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getNumberSwap(): int
    {
        return $this->number_swap;
    }

    /**
     * @param int $number_swap
     */
    public function setNumberSwap(int $number_swap): void
    {
        $this->number_swap = $number_swap;
    }

    #[ReturnTypeWillChange] public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'numberSwap' => $this->number_swap,
        ];
    }

}