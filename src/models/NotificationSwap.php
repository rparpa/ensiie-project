<?php

namespace models;


use JsonSerializable;
use ReturnTypeWillChange;

class NotificationSwap implements JsonSerializable
{

    private int $id;
    private User $user;
    private Swap $swap;
    private string $date;

    public function __construct(int $id, User $user, Swap $swap, string $date)
    {
        $this->id = $id;
        $this->user = $user;
        $this->swap = $swap;
        $this->date = $date;
    }


    #[ReturnTypeWillChange] public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->jsonSerialize(),
            'swap' => $this->swap->jsonSerialize(),
            'date' => $this->date
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Swap
     */
    public function getSwap(): Swap
    {
        return $this->swap;
    }

    /**
     * @param Swap $swap
     */
    public function setSwap(Swap $swap): void
    {
        $this->swap = $swap;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }



}