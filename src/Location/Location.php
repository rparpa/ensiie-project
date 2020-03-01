<?php

namespace Location;

class Location
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $voiture_immat;

    /**
     * @var string
     */
    private $user_email;

    /**
     * @var \DateTimeInterface
     */
    private $date_debut;

    /**
     * @var \DateTimeInterface
     */
    private $date_fin;

    /**
     * @var int
     */
    private $prix;

    /**
     * @var int
     */
    private $km_max;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Location
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getVoitureImmat()
    {
        return $this->voiture_immat;
    }
    /**
     * @param string $voiture_immat
     * @return Location
     */
    public function setVoitureImmat($voiture_immat)
    {
        $this->voiture_immat = $voiture_immat;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }
    /**
     * @param string $user_email
     * @return Location
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
        return $this;
    }


    /**
     * @return \DateTimeInterface
     */
    public function getDateDebut(): \DateTimeInterface
    {
        return $this->date_debut;
    }

    /**
     * @param \DateTimeInterface $date_debut
     * @return Location
     */
    public function setDateDebut(\DateTimeInterface $date_debut)
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateFIn(): \DateTimeInterface
    {
        return $this->date_fin;
    }

    /**
     * @param \DateTimeInterface $date_debut
     * @return Location
     */
    public function setDateFin(\DateTimeInterface $date_fin)
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     * @return Location
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return int
     */
    public function getKmMax()
    {
        return $this->km_max;
    }

    /**
     * @param int $km_max
     * @return Location
     */
    public function setKmMax($km_max)
    {
        $this->km_max = $km_max;
        return $this;
    }
}
