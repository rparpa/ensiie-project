<?php
namespace User;
use DateTimeInterface;
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
     * @param int $userId
     * @return User
     * @throws Exception
     */
    public function findOneById(int $userId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" WHERE id = :id');
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rawUser = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->userHydrator->hydrateObj($rawUser);
    }

    /**
     * @param int $userId
     */
    public function delete(int $userId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM "user" WHERE id = :id'
        );
        $stmt->bindValue(':id',$userId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param string $username
     * @param string $surname
     * @param string $name
     * @param string $mail
     * @param string $password
     * @param DateTimeInterface $creationdate
     */
    public function insert(string $username, string $surname, string $name, string $mail, string $password, DateTimeInterface $creationdate)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO "user" (username, surname, "name", mail, password, creationdate) 
            VALUES (:username, :surname, ":name", :mail, :password, :creationdate)'
        );

        $stmt->bindValue(':username', $username,PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname,PDO::PARAM_STR);
        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail,PDO::PARAM_STR);
        $stmt->bindValue(':password', $password,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param string $username
     * @param string $surname
     * @param string $name
     * @param string $mail
     * @param string $password
     * @throws Exception
     */
    public function update(int $id, string $username, string $surname, string $name, string $mail, string $password)
    {
        $user = $this->findOneById($id);
        if($user)
        {
            $stmt = $this->connection->prepare(
               'UPDATE "user" SET  
                    username = :username,
                    surname = :surname,
                    name = :name,
                    mail = :mail,
                    password = :password'
            );
            $stmt->bindValue(':username', $username?$username:$user->getUsername(),PDO::PARAM_STR);
            $stmt->bindValue(':surname', $surname,PDO::PARAM_STR);
            $stmt->bindValue(':name', $name,PDO::PARAM_STR);
            $stmt->bindValue(':mail', $mail,PDO::PARAM_STR);
            $stmt->bindValue(':password', $password,PDO::PARAM_STR);
        }
    }
}
