<?php

namespace models;

class SwapStatistique
{

    public string $date;

    public int $validate;

    public int $cancel;

    function __construct($date, $validate, $cancel)
    {
        $this->date = $date;
        $this->validate = $validate;
        $this->cancel = $cancel;
    }

}