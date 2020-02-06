<?php
namespace User;
use Exception;
use PDO;

class UserRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var UserHydrator
     */
    private UserHydrator $userHydrator;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param UserHydrator $userHydrator
     */
    public function __construct(PDO $connection, UserHydrator $userHydrator)
    {
        $this->connection = $connection;
        $this->userHydrator = $userHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = $this->userHydrator->hydrateObj($row);
            $users[] = $user;
        }

        return $users;
    }

    /**
     * @param $userId
     * @return User
     * @throws Exception
     */
    public function findOneById($userId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" WHERE id = :id');
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rawUser = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->userHydrator->hydrateObj($rawUser);
    }


}
