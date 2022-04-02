<?php

namespace models;

class Troc
{

    private int $id_item;
    private int $id_troc;

    function __construct($id_item, $id_troc){
        $this->id_item=$id_item;
        $this->id_troc=$id_troc;
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



}