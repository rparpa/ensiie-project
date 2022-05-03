<?php

namespace models;

use ReturnTypeWillChange;

class Wish
{

    protected int $id;
    protected string $mail;
    protected string $label;


    function __construct($id, $mail, $label)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->label = $label;
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
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    #[ReturnTypeWillChange] public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'mail' => $this->mail,
            'label' => $this->label
        ];
    }
}