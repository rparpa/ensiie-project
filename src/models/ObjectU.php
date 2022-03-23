<?php

namespace models;


use Cassandra\Date;
use DateTime;
use phpDocumentor\Reflection\DocBlock\Description;

class ObjectU
{

    /**
    /**
     * @var int id identifiant de l'objet
     * remarque : pas de setter pour l'identifiant
     */
    private int $id;

    /**
     * @var string proprietaire de l'objet
     */
    private string $proprietary;

    /**
     * @var string adresse de la photo
     */
    private string $picture;

    /**
     * @var string description de l'objet
     */
    private string $description;

    /**
     * @var DateTime date de creation
     */
    private DateTime $creation_date;

    /**
     * @var boolean est échangeable
     */
    private bool $is_swappable;


    /**
     * ajouté un constructeur
     */


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
     * @return DateTime
     */
    public function getCreationDate():DateTime
    {
        return $this->creation_date;
    }

    /**
     * @param DateTime $creation_date
     */
    public function setCreationDate(DateTime $creation_date):void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return bool
     */
    public function isSwappable():void
    {
        return $this->is_swappable;
    }

    /**
     * @param bool $is_swappable
     */
    public function setIsSwappable($is_swappable):void
    {
        $this->is_swappable = $is_swappable;
    }


    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }




}