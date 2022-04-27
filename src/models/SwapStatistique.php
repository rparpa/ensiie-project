<?php

namespace models;

use ReturnTypeWillChange;

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

    #[ReturnTypeWillChange] public function jsonSerialize()
    {
        return [
            'date' => $this->date,
            'validate' => $this->validate,
            'cancel' => $this->cancel
        ];
    }

}