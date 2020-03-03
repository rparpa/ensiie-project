<?php


namespace Invoice;


use DateTimeInterface;
use Order\Order;

class Invoice
{
    /**
     * @var int
     */
    private ?int $id = null;

    /**
     * @var Order
     */
    private Order $order;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $date;

    /**
     * @var int
     */
    private int $orderNumber;

    /**
     * @var string
     */
    private string $client;

    /**
     * @var string
     */
    private string $validator;

    /**
     * @var string
     */
    private string $orderDetail;

    /**
     * @var float
     */
    private float $orderPrice;

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getValidator(): string
    {
        return $this->validator;
    }

    /**
     * @param string $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return string
     */
    public function getOrderDetail(): string
    {
        return $this->orderDetail;
    }

    /**
     * @param string $orderDetail
     */
    public function setOrderDetail($orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * @return float
     */
    public function getOrderPrice(): float
    {
        return $this->orderPrice;
    }

    /**
     * @param float $orderPrice
     */
    public function setOrderPrice( $orderPrice)
    {
        $this->orderPrice = $orderPrice;
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
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }



}