<?php

namespace models;

use ReturnTypeWillChange;

class SwapStatistique
{

    private string $date;

    private int $validate;

    private int $cancel;

    function __construct($date, $validate, $cancel)
    {
        $this->date = $date;
        $this->validate = $validate;
        $this->cancel = $cancel;
    }

    #[ReturnTypeWillChange] public function jsonSerialize(): array
    {
        return [
            'date' => $this->date,
            'validate' => $this->validate,
            'cancel' => $this->cancel
        ];
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

    /**
     * @return int
     */
    public function getValidate(): int
    {
        return $this->validate;
    }

    /**
     * @param int $validate
     */
    public function setValidate(int $validate): void
    {
        $this->validate = $validate;
    }

    /**
     * @return int
     */
    public function getCancel(): int
    {
        return $this->cancel;
    }

    /**
     * @param int $cancel
     */
    public function setCancel(int $cancel): void
    {
        $this->cancel = $cancel;
    }

}