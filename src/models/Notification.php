<?php

namespace models;

use ReturnTypeWillChange;

class Notification
{

    private int $id;
    private string $content;
    private string $creation_date;


    /**
     * @param int $id
     * @param string $content
     * @param string $creation_date
     */
    public function __construct(int $id, string $content, string $creation_date)
    {
        $this->id = $id;
        $this->content = $content;
        $this->creation_date = $creation_date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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

    #[ReturnTypeWillChange] public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'creationDate' => $this->creation_date
        ];
    }
}