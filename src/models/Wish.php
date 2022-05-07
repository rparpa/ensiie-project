<?php

namespace models;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use ReturnTypeWillChange;

class Wish implements JsonSerializable
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

    #[ArrayShape(['id' => "int", 'mail' => "string", 'label' => "string"])]
    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'mail' => $this->mail,
            'label' => $this->label
        ];
    }
}