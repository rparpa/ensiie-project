<?php


class Task
{

    private int $id;
    private string $title;
    private string $content;
    private DateTimeInterface $creationdate;
    private string $state;
    private int $idcreator;
    private int $idassignee;
    private int $idproject;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function setId(int $id): Task
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Task
     */
    public function setTitle(string $title): Task
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Task
     */
    public function setContent(string $content): Task
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreationdate(): DateTimeInterface
    {
        return $this->content;
    }

    /**
     * @param DateTimeInterface
     * @return Task
     */
    public function setCreationdate(DateTimeInterface $creationdate): Task
    {
        $this->creationdate = $creationdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Task
     */
    public function setState(string $state): Task
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdcreator(): int
    {
        return $this->idcreator;
    }

    /**
     * @param int $idcreator
     * @return Task
     */
    public function setIdcreator(int $idcreator): Task
    {
        $this->idcreator = $idcreator;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdassignee(): int
    {
        return $this->idassignee;
    }

    /**
     * @param int $idassignee
     * @return Task
     */
    public function setIdassignee(int $idassignee): Task
    {
        $this->idassignee = $idassignee;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdproject(): int
    {
        return $this->idproject;
    }

    /**
     * @param int $idproject
     * @return Task
     */
    public function setIdproject(int $idproject): Task
    {
        $this->idproject = $idproject;
        return $this;
    }

}