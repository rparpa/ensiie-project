<?php
namespace Order;

use Sandwich\Sandwich;

/**
 * Class OrderService
 * @package Order
 */
class OrderService
{

    private OrderRepository $orderRepository;

    private ?array $errors = [];

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getAllOrders() {
        $this->resetErrors();
        $orders = [];
        $orders = $this->orderRepository->getAll();
        return $orders;
    }

    //TODO
    // get validated
    // get not-validated
    // get by client 

    public function getOrderById($orderId) {
        $this->resetErrors();
        $order = null;
        if($orderId == null)
            $this->errors['id'] = 'Order id shouldn\'t be null.';
        else if($orderId < 0)
            $this->errors['id'] = 'Order id can\'t be inferior to zero.';
        else {
            $order = $this->orderRepository->findOneById($orderId);
            if ($order == null)
                $this->errors['id'] = 'Order id ' . $orderId . ' doesn\'t exists.';
        }

        return $order;
    }

    public function saveOrder(Order $order) {
        $this->resetErrors();
        if($this->validateOrder($order))
        {
            if (null != $order->getId())
                $this->errors['id'] = 'Order can\'t be updated. Please create a new order.';
            else {
                //TODO pour chaque dwich sans id créer dwich et set id
                $order = $this->orderRepository->createOrder($order);
            }
        }
        return $order;
    }

    public function deleteOrder(Order $order) {
        $this->resetErrors();
        if($order->getId() == null) {
            $this->errors['id'] = 'Order id shouldn\'t be null.';
        } else {
            $result = $this->orderRepository->deleteOrder($order);
        }
        return $result;
    }

    private function validateOrder(Order $order) {
        $result = true;
        //validate Sandwich
        return $result;
    }

    private function validateSandwich(Sandwich $sandwich) {
        $result = true;

        return $result;
    }

    //TODO validate client & admin

    private function resetErrors() {
        $this->errors = [];
    }
}