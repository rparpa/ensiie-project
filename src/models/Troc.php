<?php

namespace models;


class Troc {
    private int $id;
    private string $creation_date;
    private string $end_date;
    private bool $is_done;
    private int $is_accepted; // 0 = en attente, 1 = accepté, 2 = refusé

    function __construct($id, $creation_date, $end_date, $is_done) {
        $this->id = $id;
        $this->creation_date = $creation_date;
        $this->end_date = $end_date;
        $this->is_done = $is_done;
        $this->is_accepted = 0;
    }


    function getId(): int {
        return $this->id;
    }

    public function getIsDone(): int{
        return $this->is_done;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string{
        return $this->creation_date;
    }

    /**
     * @param $creation_date
     * @return void
     */
    public function setCreationDate($creation_date): void {
        $this->creation_date = $creation_date;
    }

    /**
     * @return string
     */
    public function getEndDate(): string{
        return $this->end_date;
    }

    /**
     * @param $end_date
     * @return void
     */
    public function setEndDate($end_date): void {
        $this->end_date = $end_date;
    }
    /**
     * @param $is_done
     * @return void
     */
    public function setIsDone($is_done): void {
        $this->is_done = $is_done;
    }

    /**
     * @return int
     */
    public function getIsAccepted(): int{
        return $this->is_accepted;
    }

    /**
     * @param bool $is_accepted
     */
    public function setIsAccepted(int $is_accepted): void{
        $this->is_accepted = $is_accepted;
    }


}