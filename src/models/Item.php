<?php

namespace models;

use JetBrains\PhpStorm\ArrayShape;
use phpDocumentor\Reflection\DocBlock\Description;
use JsonSerializable;
use ReturnTypeWillChange;

class Item implements JsonSerializable
{

    private int $id;

    private User $proprietary;

    private string $name;

    private string $picture;

    private string $description;

    private string $creation_date;

    private bool $is_swappable;

    private array $categories;

    function __construct(int    $id,
                         string $name,
                         User   $proprietary,
                         string $picture,
                         string $description,
                         string $creation_date,
                         bool   $is_swappable,
                         array  $categories)
    {
        $this->id = $id;
        $this->name = $name;
        $this->proprietary = $proprietary;
        $this->picture = $picture;
        $this->description = $description;
        $this->creation_date = $creation_date;
        $this->is_swappable = $is_swappable;
        $this->categories = $categories;
    }

    #[ArrayShape(['id' => "int", 'name' => "string", 'proprietary' => "array", 'picture' => "string", 'description' => "string", 'creation_date' => "string", 'is_swappable' => "bool", 'categories' => "array"])]
    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $arrayCategories = [];
        foreach ($this->categories as $category) {
            $arrayCategories[] = $category->jsonSerialize();
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'proprietary' => $this->proprietary->jsonSerialize(),
            'picture' => $this->picture,
            'description' => $this->description,
            'creation_date' => $this->creation_date,
            'is_swappable' => $this->is_swappable,
            'categories' => $arrayCategories
        ];
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function getProprietary(): User
    {
        return $this->proprietary;
    }

    /**
     * @param string $proprietary
     */
    public function setProprietary(string $proprietary): void
    {
        $this->proprietary = $proprietary;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    /**
     * @param string $creation_date
     */
    public function setCreationDate(string $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return bool
     */
    public function getIsSwappable(): bool
    {
        return $this->is_swappable;
    }

    /**
     * @param bool $is_swappable
     */
    public function setIsSwappable($is_swappable): void
    {
        $this->is_swappable = $is_swappable;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    function __toString()
    {
        return ("ID: $this->id \t Propri: $this->proprietary \t Picture: $this->picture \t Description: $this->description \t Creation : $this->creation_date \t Swappable: $this->is_swappable");
    }


}