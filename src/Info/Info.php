<?php


namespace Info;


class Info
{

    private int $id;
    private string $source;
    private int $idsource;
    private int $idcreator;
    private string $title;
    private string $content;
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
     * @return Info
     */
    public function setId(int $id): Info
    {
        $this->id = $id;
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
     * @return Info
     */
    public function setIdsource(int $idsource): Info
    {
        $this->idsource = $idsource;
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
     * @return Info
     */
    public function setIdcreator(int $idcreator): Info
    {
        $this->idcreator = $idcreator;
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
     * @return Info
     */
    public function setSource(string $source): Info
    {
        $this->source = $source;
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
     * @return Info
     */
    public function setTitle(string $title): Info
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
     * @return Info
     */
    public function setContent(string $content): Info
    {
        $this->content = $content;
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
     * @return Info
     */
    public function setCreationdate(DateTimeInterface $creationdate): Info
    {
        $this->creationdate = $creationdate;
        return $this;
    }

}