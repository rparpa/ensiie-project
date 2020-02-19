<?php


namespace Organization;


use DateTimeInterface;

class Organization
{

    private int $id;
    private string $name;
    private DateTimeInterface $creationdate;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return "organization";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Organization;
     */
    public function setId(int $id): Organization
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
     * @return Organization;
     */
    public function setName(string $name): Organization
    {
        $this->name = $name;
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
     * @return Organization
     */
    public function setCreationdate(DateTimeInterface $creationdate): Organization
    {
        $this->creationdate = $creationdate;
        return $this;
    }

}