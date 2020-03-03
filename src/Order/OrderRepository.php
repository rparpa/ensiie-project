<?php
namespace Order;

use DateTimeImmutable;
use Sandwich\Sandwich;
use PDO;
use Sandwich\SandwichRepository;
use User\User;
use User\UserRepository;

/**
 * Class OrderRepository
 * @package Order
 */
class OrderRepository
{

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * OrderRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAll()
    {
        $rows = $this->connection->query(
            'SELECT * FROM "order"')
            ->fetchAll(PDO::FETCH_OBJ);
            
        $orders = [];
        foreach ($rows as $row) {
            $order = new Order();
            $order
                ->setId($row->id)
                ->setDate(new DateTimeImmutable($row->order_date))
                ->setApproval($row->approval)
                ->setClient($this->fetchUser($row->client_id));
            $order->setValidator($this->fetchUser($row->validator_id));

            $orders[] = $order;
        }

        foreach ($orders as $order) {
            $order->setSandwichs(
                $this->fetchSandwichs($order->getId())
            );
        }


        return $orders;
    }

    /**
     * @param $orderId
     * @return Order|null
     * @throws \Exception
     */
    public function findOneById($orderId)
    {        
        $query = $this->connection->prepare(
            'SELECT * FROM "order" WHERE id = :id');
        
        $query->bindValue(':id', $orderId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $order = new Order();

        if($row) {
            $order
                ->setId($row['id'])
                ->setDate(new DateTimeImmutable($row['order_date']))
                ->setApproval($row['approval'])
                ->setClient($this->fetchUser($row['client_id']));
            $order->setValidator($this->fetchUser($row['validator_id']));

            $order->setSandwichs(
                $this->fetchSandwichs($order->getId())
            );
        } else {
            $order = null;
        }

        return $order;
    }

    /**
     * @param Order $newOrder
     * @return Order
     */
    public function createOrder(Order $newOrder)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "order"(order_date, approval, client_id, validator_id) VALUES (:order_date, :approval, :client_id, :validator_id)');
        
        $query->bindValue(':order_date', $newOrder->getDate()->format("Y-m-d"));
        $query->bindValue(':approval', $newOrder->getApproval());
        $query->bindValue(':client_id', $newOrder->getClient()->getId());
        $query->bindValue(':validator_id', $newOrder->getValidator()->getId());

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        else
        {
            $newOrder->setId($this->connection->lastInsertId());
            if( $newOrder->getSandwichs() != null )
            {
                foreach ($newOrder->getSandwichs() as $sandwich)
                {
                    $this->addSandwich($newOrder->getId(), $sandwich->getId());
                }
            }
        }
        return $newOrder;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function setApproval(Order $order)
    {
        $query = $this->connection->prepare(
            'UPDATE order
            SET approval = :approval
            WHERE id = :id');

        $query->bindValue(':id', $order->getId());
        $query->bindValue(':approval', $order->getApproval());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $result;
    }

    /**
     * @param Order $orderToDelete
     * @return bool
     */
    public function deleteOrder(Order $orderToDelete)
    {
        $query = $this->connection->prepare('DELETE FROM "order" WHERE id = :id');
        
        $query->bindValue(':id', $orderToDelete->getId());
        
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        else
        {
            if( $orderToDelete->getSandwichs() != null)
            {
                foreach ($orderToDelete->getSandwichs() as $sandwich)
                {
                    $this->removeSandwich($orderToDelete->getId(), $sandwich->getId());
                }
            }
        }

        return $result;
    }

    /**
     * @param $orderId
     * @param $sandwichId
     */
    private function addSandwich($orderId, $sandwichId)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "order_sandwich"(order_id, sandwich_id) 
            VALUES (:order_id, :sandwich_id)');
        
        $query->bindValue(':order_id', $orderId);
        $query->bindValue(':sandwich_id', $sandwichId);

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    /**
     * @param $orderId
     * @param $sandwichId
     */
    private function removeSandwich($orderId, $sandwichId)
    {
        $query = $this->connection->prepare(
            'DELETE 
            FROM "order_sandwich" 
            WHERE order_id = :order_id 
            AND sandwich_id = :sandwich_id');
        
        $query->bindValue(':order_id', $orderId);
        $query->bindValue(':sandwich_id', $sandwichId);

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }

    /**
     * @param $orderId
     * @return array
     */
    private function fetchSandwichs($orderId)
    {
        $query = $this->connection->prepare(
            'SELECT order_sandwich.sandwich_id AS id
            FROM order_sandwich
            WHERE order_sandwich.order_id = :orderId');
        
        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);

        $sandwichRepository = new SandwichRepository($this->connection);
        
        $sandwichs = [];
        foreach ($rows as $row) {
            $sandwich = new Sandwich();
            $sandwich = $sandwichRepository->findOneById($row->id);
            $sandwichs[] = $sandwich;
        }

        return $sandwichs;
    }

    /**
     * @param $orderId
     * @return User
     */
    private function fetchUser($orderId)
    {
        $query = $this->connection->prepare(
            'SELECT id AS id
            FROM "user"
            WHERE id = :orderId');

        $query->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ);


        $userRepository = new UserRepository($this->connection);
        $user = new User();
        $user = $userRepository->findOneById($row->id);

        return $user;
    }

}