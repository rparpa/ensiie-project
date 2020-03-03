<?php
namespace Order;

use DateTimeInterface;
use User\User;

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

    /**
     * @var User
     */
    private User $client;

    /**
     * @var User
     */
    private User $validator;

    /**
     * @return User
     */
    public function getClient(): User
    {
        return $this->client;
    }

    /**
     * @param User $client
     * @return Order
     */
    public function setClient(User $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return User
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param User $validator
     * @return Order
     */
    public function setValidator(User $validator)
    {
        $this->validator = $validator;
        return $this;
    }

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

    public function getTotalPrice()
    {
        $sum = 0;
        $sandwiches = $this->getSandwichs();
        if ($sandwiches != null)
        {
            foreach ($sandwiches as $sandwich)
            {
                $ingredients = $sandwich->getIngredients();
                if ($ingredients != null)
                {
                    foreach ($ingredients as $ingredient)
                    {
                        $sum += $ingredient->getPrice();
                    }
                }
            }
        }
        return $sum;
    }
}