<?php

namespace models;


class Swap
{
    private int $id;
    private string $creation_date;
    private string $end_date;
    private bool $is_done;
    private int $status; // 0 = en attente, 1 = accepté, 2 = refusé
    private string $user_from;


    private string $user_to;
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


    function getId(): int
    {
        return $this->id;
    }

    public function getIsDone(): int
    {
        return $this->is_done;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    /**
     * @param $creation_date
     * @return void
     */
    public function setCreationDate($creation_date): void
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
     * @param $end_date
     * @return void
     */
    public function setEndDate($end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @param $is_done
     * @return void
     */
    public function setIsDone($is_done): void
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
     * @param bool $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getUserFrom(): string
    {
        return $this->user_from;
    }

    /**
     * @param string $user_from
     */
    public function setUserFrom(string $user_from): void
    {
        $this->user_from = $user_from;
    }

    /**
     * @return string
     */
    public function getUserTo(): string
    {
        return $this->user_to;
    }

    /**
     * @param string $user_to
     */
    public function setUserTo(string $user_to): void
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