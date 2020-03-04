<?php
namespace Order;

use Invoice\Invoice;
use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use User\User;
use User\UserRepository;
use Invoice\InvoiceRepository;

/**
 * Class OrderService
 * @package Order
 */
class OrderService
{

    //TODO
    // get orders by client

    private OrderRepository $orderRepository;
    private SandwichRepository $sandwichRepository;
    private UserRepository $userRepository;
    private InvoiceRepository $invoiceRepository;

    private ?array $errors = [];

    public function __construct(OrderRepository $orderRepository, SandwichRepository $sandwichRepository, UserRepository $userRepository, InvoiceRepository $invoiceRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->sandwichRepository = $sandwichRepository;
        $this->userRepository = $userRepository;
        $this->invoiceRepository = $invoiceRepository;
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

    public function approveOrder(Order $order) {
        $this->resetErrors();
        $order->setApproval(true);

        $result = true;
        if (null == $order->getId()) {
            $result = false;
            $this->errors['id'] = 'Order id shouldn\'t be null for validation.';
        }
        
        if($order->getValidator() == null) {
            $result = false;
            $this->errors['validator_empty'] = 'There is no Validator.';
            
        } else if (! $this->validateAdmin($order->getValidator()) ) {
            $result = false;
        }

        if($result) {
            if($this->orderRepository->setApproval($order)) {
                $newInvoice = new Invoice();
                $newInvoice->setOrder($order);
                $this->invoiceRepository->createInvoice($newInvoice);
            }
        }
    }

    public function deleteOrder(Order $order) {
        $this->resetErrors();
        if($order->getId() == null)
            $this->errors['id'] = 'Order id shouldn\'t be null.';
        else
            $result = $this->orderRepository->deleteOrder($order);
        return $result;
    }

    public function addSandwich(Order $order, Sandwich $sandwich)
    {
        $this->resetErrors();
        $result = false;
        if ($order == null)
        {
            $this->errors['order_null'] = 'Order shouldn\'t be null.';
            return $result;
        }
        if ($sandwich == null)
        {
            $this->errors['sandwich_null'] = 'Sandwich shouldn\'t be null.';
            return $result;
        }
        if ($order->getId() == null)
        {
            $this->errors['id'] = 'Order id shouldn\'t be null.';
            return $result;
        }
        if ($sandwich->getId() == null)
        {
            $this->errors['id'] = 'Sandwich id shouldn\'t be null.';
            return $result;
        }
        $result = $this->orderRepository->addSandwich($order->getId(), $sandwich->getId());
        if ($result == false)
            $this->errors['sandwich_add'] = 'Sandwich cannot be added';

        return $result;
    }

    public function removeSandwich(Order $order, Sandwich $sandwich)
    {
        $this->resetErrors();
        $result = false;
        if ($order == null)
        {
            $this->errors['order_null'] = 'Order shouldn\'t be null.';
            return $result;
        }
        if ($sandwich == null)
        {
            $this->errors['sandwich_null'] = 'Sandwich shouldn\'t be null.';
            return $result;
        }
        if ($order->getId() == null)
        {
            $this->errors['id'] = 'Order id shouldn\'t be null.';
            return $result;
        }
        if ($sandwich->getId() == null)
        {
            $this->errors['id'] = 'Sandwich id shouldn\'t be null.';
            return $result;
        }
        $result = $this->orderRepository->removeSandwich($order->getId(), $sandwich->getId());
        if ($result == false)
            $this->errors['sandwich_add'] = 'Sandwich cannot be added';

        return $result;
    }

    private function validateOrder(Order $order) {
        $result = true;

        #Sandwichs control
        if($order->getSandwichs() != null) {
            foreach($order->getSandwichs() as $sandwich) {
                if(! $this->validateSandwich($sandwich)) {
                    $result = false;
                }
            }
        } else {
            $result = false;
            $this->errors['sandwichs_empty'] = 'This order is empty.';
        }

        #Client control
        if($order->getClient() != null) {
            if(! $this->validateClient($order->getClient())) {
                $result = false;
            }
        } else {
            $result = false;
            $this->errors['client_empty'] = 'There is no Client.';
        }

        #Admin control
        if($order->getValidator() != null) {
            $result = false;
            $this->errors['admin_filled'] = 'Validator must be empty on order creation.';
        }

        return $result;
    }

private function validateClient(User $userClient)
{
    $result = true;

    if(null != $userClient->getId()) {
        $existingClient = $this->userRepository->findOneById($userClient->getId());
        if (null == $existingClient) {
            $result = false;
            $this->errors['user_id'] = 'This id doesn\'t exists for a user.';
        }
    } else if (null == $userClient->getPseudo() || '' == $userClient->getPseudo() ) {
            $result = false;
            $this->errors['user_pseudo'] = 'Pseudo is mandatory.';
    }

    return $result;
}

private function validateAdmin(User $userAdmin) {
    $result = true;

    if(null != $userAdmin->getId()) {
        $existingClient = $this->userRepository->findOneById($userAdmin->getId());
        if (null == $userAdmin) {
            $result = false;
            $this->errors['user_id'] = 'This id doesn\'t exists for a user.';
        }
        if (!$userAdmin->isValidator()) {
            $result = false;
            $this->errors['user_validator'] = 'User isn\'t validator.';
        }
    } else {
        if (null == $userAdmin->getPseudo() || '' == $userAdmin->getPseudo() ) {
            $result = false;
            $this->errors['user_pseudo'] = 'Pseudo is mandatory.';
        }
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