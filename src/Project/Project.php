<?php


namespace Project;


use DateTimeInterface;

class Project
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $idorganization;
    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $creationdate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId(int $id): Project
    {
        $this->id = $id;
        return $this;
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
     * @return Project
     */
    public function setName(string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdorganization(): int
    {
        return $this->idorganization;
    }

    /**
     * @param int $idorganization
     * @return Project
     */
    public function setIdorganization(int $idorganization): Project
    {
        $this->idorganization = $idorganization;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreationdate(): DateTimeInterface
    {
        return $this->creationdate;
    }

    /**
     * @param DateTimeInterface $creationdate
     * @return Project
     */
    public function setCreationdate(DateTimeInterface $creationdate): Project
    {
        $this->creationdate = $creationdate;
        return $this;
    }


}