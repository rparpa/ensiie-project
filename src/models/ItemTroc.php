<?php

namespace models;

use ReturnTypeWillChange;

class ItemTroc
{

    private int $id_item;
    private int $id_troc;

    /**
     * @param int $id_item
     * @param int $id_troc
     */
    public function __construct(int $id_item, int $id_troc)
    {
        $this->id_item = $id_item;
        $this->id_troc = $id_troc;
    }

    /**
     * @return int
     */
    public function getIdItem(): int
    {
        return $this->id_item;
    }

    /**
     * @return int
     */
    public function getIdTroc(): int
    {
        return $this->id_troc;
    }

    #[ReturnTypeWillChange] public function jsonSerialize()
    {
        return [
            'idItem' => $this->id_item,
            'idTroc' => $this->id_troc
        ];
    }
}