<?php
namespace Order;

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;

/**
 * Class OrderService
 * @package Order
 */
class OrderService
{

    //TODO
    // get orders by client
    // ajout du client à la creation
    // ajout de l'admin à la validation (setApproval) 
    
    //TODO 
    //fonction validate client & validate admin 
    //          -> même shéma que pour le sandwich


    private OrderRepository $orderRepository;
    private SandwichRepository $sandwichRepository;

    private ?array $errors = [];

    public function __construct(OrderRepository $orderRepository, SandwichRepository $sandwichRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->sandwichRepository = $sandwichRepository;
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

    public function getApprovedOrders() {
        $this->resetErrors();
        $filteredOrders = [];
        $orders = $this->orderRepository->getAll();
        foreach ($orders as $order) {
            if($order->getApproval()) {
                $filteredOrders[] = $order;
            }
        }
        return $filteredOrders;
    }

    public function getPendingOrders() {
        $this->resetErrors();
        $filteredOrders = [];
        $orders = $this->orderRepository->getAll();
        foreach ($orders as $order) {
            if(!$order->getApproval()) {
                $filteredOrders[] = $order;
            }
        }
        return $filteredOrders;
    }
    
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

    public function createOrder(Order $order) {
        $this->resetErrors();
        $validation = $this->validateOrder($order);
        if($validation) {
            if (null != $order->getId())
                $this->errors['id'] = 'Order can\'t be updated. Please create a new order.';
            else {
                foreach ($order->getSandwichs() as &$sandwich) {
                    if($sandwich->getId() == null) {
                        $sandwich = $this->sandwichRepository->createSandwich($sandwich);
                    }
                }
                $order = $this->orderRepository->createOrder($order);
            }
        }
        return $order;
    }

    public function setApproval(Order $order) {
        $this->resetErrors();
        if (null == $order->getId()) {
            $this->errors['id'] = 'Order id shouldn\'t be null for validation.';
        } else {
            $this->orderRepository->setApproval($order);
        }
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
        if( $order->getSandwichs() != null ) {
            foreach ($order->getSandwichs() as $sandwich) {
                if(! $this->validateSandwich($sandwich)) {
                    $result = false;
                }
            }
        } else {
            $result = false;
            $this->errors['sandwichs_empty'] = 'This order is empty.';
        }
        return $result;
    }

    private function validateSandwich(Sandwich $sandwich) {
        $result = true;

        if (null != $sandwich->getId()) {
            $existingSandwich = $this->sandwichRepository->findOneById($sandwich->getId());
            if (null == $existingSandwich) {
                $result = false;
                $this->errors['sandwich_id'] = 'This id doesn\'t exists for a sandwich.';
            }
        } else {
            if (null == $sandwich->getLabel() || '' == $sandwich->getLabel() ) {
                $result = false;
                $this->errors['sandwich_label'] = 'Label is mandatory.';    
            }
        }

        return $result;
    }

    private function resetErrors() {
        $this->errors = [];
    }
}