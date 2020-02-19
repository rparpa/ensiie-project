<?php


namespace Meeting;


use DateTimeInterface;

class Meeting
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $source;

    /**
     * @var int
     */
    private int $idsource;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $place;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $creationdate;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return "meeting";
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
     * @return Meeting
     */
    public function setId(int $id): Meeting
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return Meeting
     */
    public function setSource(string $source): Meeting
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdsource(): int
    {
        return $this->idsource;
    }

    /**
     * @param int $idsource
     * @return Meeting
     */
    public function setIdsource(int $idsource): Meeting
    {
        $this->idsource = $idsource;
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
     * @return Meeting
     */
    public function setName(string $name): Meeting
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return Meeting
     */
    public function setPlace(string $place): Meeting
    {
        $this->place = $place;
        return $this;
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
     * @return Meeting
     */
    public function setDescription(string $description): Meeting
    {
        $this->description = $description;
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
     * @return Meeting
     */
    public function setCreationdate(DateTimeInterface $creationdate): Meeting
    {
        $this->creationdate = $creationdate;
        return $this;
    }


}
