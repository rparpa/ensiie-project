<?php
namespace Car;

class Car
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $immat;

    /**
     * @var \DateTimeInterface
     */
    private $date_immat;

    /**
     * @var string
     */
    private $marque;

    /**
     * @var string
     */
    private $modele;

    /**
     * @var int
     */
    private $puissance;

    /**
     * @var string
     */
    private $finition;

    private $image;

    private $prix;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getImmat()
    {
        return $this->immat;
    }

    public function setImmat($immat)
    {
        $this->immat = $immat;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateImmat(): \DateTimeInterface
    {
        return $this->date_immat;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return User
     */
    public function setDateImmat(\DateTimeInterface $date_immat)
    {
        $this->date_immat = $date_immat;
        return $this;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
        return $this;
    }

    public function getModele()
    {
        return $this->modele;
    }

    public function setModele($modele)
    {
        $this->modele = $modele;
        return $this;
    }

    public function getPuissance()
    {
        return $this->puissance;
    }

    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;
        return $this;
    }

    public function getFinition()
    {
        return $this->finition;
    }

    public function setFinition($finition)
    {
        $this->finition = $finition;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }
}

