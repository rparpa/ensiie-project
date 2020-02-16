<?php


namespace Message;


use DateTimeInterface;

class Message
{
    private int $id;
    private int $iduser;
    private string $source;
    private string $message;
    private DateTimeInterface $creationdate;
    private int $idsource;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Message
     */
    public function setId(int $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIduser(): int
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     * @return Message
     */
    public function setIduser(int $iduser): Message
    {
        $this->iduser = $iduser;
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
     * @return Message
     */
    public function setSource(string $source): Message
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage(string $message): Message
    {
        $this->message = $message;
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
     * @return Message
     */
    public function setCreationdate(DateTimeInterface $creationdate): Message
    {
        $this->creationdate = $creationdate;
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
     * @return Message
     */
    public function setIdsource(int $idsource): Message
    {
        $this->idsource = $idsource;
        return $this;
    }


}