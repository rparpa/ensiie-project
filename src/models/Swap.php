<?php

namespace models;


use JsonSerializable;
use ReturnTypeWillChange;

class Swap implements JsonSerializable
{
    private int $id;
    private string $creation_date;
    private string $end_date;
    private bool $is_done;
    private int $status; // 0 = en attente, 1 = accepté, 2 = refusé
    private User $user_from;
    private User $user_to;
    private array $items;

    function __construct($id, $creation_date, $end_date, $is_done, $status, $user_from, $user_to, $items)
    {
        $this->id = $id;
        $this->creation_date = $creation_date;
        if ($end_date != null) {
            $this->end_date = $end_date;
        } else {
            $this->end_date = '';
        }

        $this->is_done = $is_done;
        $this->status = $status;
        $this->user_from = $user_from;
        $this->user_to = $user_to;
        $this->items = $items;
    }

    #[ReturnTypeWillChange] public function jsonSerialize(): array
    {
        $arrayItems = [];
        foreach ($this->items as $item) {
            $arrayItems[] = $item->jsonSerialize();
        }
        return [
            'id' => $this->id,
            'creation_date' => $this->creation_date,
            'end_date' => $this->end_date,
            'is_done' => $this->is_done,
            'status' => $this->status,
            'user_from' => $this->user_from->jsonSerialize(),
            'user_to' => $this->user_to->jsonSerialize(),
            'items' => $arrayItems
        ];
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
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->end_date;
    }

    /**
     * @param string $end_date
     */
    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @return bool
     */
    public function isIsDone(): bool
    {
        return $this->is_done;
    }

    /**
     * @param bool $is_done
     */
    public function setIsDone(bool $is_done): void
    {
        $this->is_done = $is_done;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return User
     */
    public function getUserFrom(): User
    {
        return $this->user_from;
    }

    /**
     * @param User $user_from
     */
    public function setUserFrom(User $user_from): void
    {
        $this->user_from = $user_from;
    }

    /**
     * @return User
     */
    public function getUserTo(): User
    {
        return $this->user_to;
    }

    /**
     * @param User $user_to
     */
    public function setUserTo(User $user_to): void
    {
        $this->user_to = $user_to;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }



}