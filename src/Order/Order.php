<?php
namespace Order;

use DateTimeInterface;

class Order
{
    /**
     * @var int
     */
    private ?int $id = null;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $date;
    
    /**
     * @var bool
     */
    private bool $approval;

    /**
     * @var array
     */
    private ?array $sandwichs = null;

    //TODO ADD CLIENT
    //TODO ADD VALIDATOR
    //TODO ADD BILL HAVING CALCULATE PRICE

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $Date
     * @return Order
     */
    public function setDate(DateTimeInterface $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function getApproval()
    {
        return $this->approval;
    }

    /**
     * @param bool $approval
     * @return Order
     */
    public function setApproval($approval)
    {
        $this->approval = $approval;
        return $this;
    }
    
    /**
     * @return array of Sandwich
     */
    public function getSandwichs()
    {
        return $this->sandwichs;
    }

    /**
     * @param array of Sandwich
     * @return Order
     */
    public function setSandwichs($sandwichs)
    {
        $this->sandwichs = $sandwichs;
        return $this;
    }
}