<?php
namespace Order;

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use User\User;
use User\UserRepository;

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


    private OrderRepository $orderRepository;
    private SandwichRepository $sandwichRepository;
    private UserRepository $userRepository;

    private ?array $errors = [];

    public function __construct(OrderRepository $orderRepository, SandwichRepository $sandwichRepository, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->sandwichRepository = $sandwichRepository;
        $this->userRepository = $userRepository;
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
        //TODO créer une facture si renvoie vraie
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
        if ($order->getClient() != null)
        {
            if (! $this->validateClient($order->getClient()))
            {
                $result = false;
            }
        }
        else
        {
            $result = false;
            $this->errors['client_empty'] = 'There is no Client.';
        }

        if ($order->getValidator() != null)
        {
            if (! $this->validateAdmin($order->getValidator()))
            {
                $result = false;
            }
        }
        else
        {
            $result = false;
            $this->errors['validator_empty'] = 'There is no Validator.';
        }
        return $result;
    }

private function validateClient(User $userClient)
{
    $result = true;

    if(null != $userClient->getId())
    {
        $existingClient = $this->userRepository->findOneById($userClient->getId());
        if (null == $userClient)
        {
            $result = false;
            $this->errors['user_id'] = 'This id doesn\'t exists for a user.';
        }
    }
    else
    {
        if (null == $userClient->getPseudo() || '' == $userClient->getPseudo() )
        {
            $result = false;
            $this->errors['user_pseudo'] = 'Pseudo is mandatory.';
        }
    }
    return $result;
}

    private function validateAdmin(User $userAdmin)
    {
        $result = true;

        if(null != $userAdmin->getId())
        {
            $existingClient = $this->userRepository->findOneById($userAdmin->getId());
            if (null == $userAdmin)
            {
                $result = false;
                $this->errors['user_id'] = 'This id doesn\'t exists for a user.';
            }
            if (!$userAdmin->isValidator())
            {
                $result = false;
                $this->errors['user_validator'] = 'User isn\'t validator.';
            }
        }
        else
        {
            if (null == $userAdmin->getPseudo() || '' == $userAdmin->getPseudo() )
            {
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