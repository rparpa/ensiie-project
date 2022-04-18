<?php

namespace models;


class Item
{

    function __construct(int    $id,
                         string $name,
                         string $proprietary,
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


    /**
     * /**
     * @var int id identifiant de l'objet
     * remarque : pas de setter pour l'identifiant
     */
    public int $id;

    /**
     * @var string proprietaire de l'objet
     */
    public string $proprietary;

    /**
     * @var string nom de l'objet
     */
    public string $name;


    /**
     * @var string adresse de la photo
     */
    public string $picture;

    /**
     * @var string description de l'objet
     */
    public string $description;

    /**
     * @var string date de creation
     */
    public string $creation_date;

    /**
     * @var boolean est échangeable
     */
    public bool $is_swappable;

    public array $categories;


    /**
     * ajouté un constructeur
     */


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getProprietary(): string
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

    public function getCategories(): array {
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