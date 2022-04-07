<?php

namespace models;

class ItemCategory
{

    private int $id_item;
    private int $id_category;

    /**
     * @param int $id_item
     * @param int $id_category
     */
    public function __construct(int $id_item, int $id_category)
    {
        $this->id_item = $id_item;
        $this->id_category = $id_category;
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
    public function getIdCategory(): int
    {
        return $this->id_category;
    }





}