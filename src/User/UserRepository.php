<?php
namespace User;
use DateTimeImmutable;
use PDO;

class UserRepository
{
    /**
     * @var \PDO
     */
    private PDO $connection;

    /**
     * UserRepository constructor.
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
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new DateTimeImmutable($row->birthday))
                ->setPseudo($row->pseudo)
                ->setMail($row->mail)
                ->setPassword($row->password);
                $user->setIsValidator($row->isvalidator);

            $users[] = $user;
        }

        return $users;
    }

    public function createUser(User $newUser)
    {
        $query = $this->connection->prepare('INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password, isvalidator) VALUES (:firstname , :lastname, :birthday, :pseudo, :mail, :password, :isvalidator)');
        $query->bindValue(':firstname', $newUser->getFirstname());
        $query->bindValue(':lastname', $newUser->getLastname());
        $query->bindValue(':birthday', $newUser->getBirthday()->format("Y-m-d"));
        $query->bindValue(':pseudo', $newUser->getPseudo());
        $query->bindValue(':mail', $newUser->getMail());
        $query->bindValue(':password', crypt($newUser->getPassword(), 'st'));
        $query->bindValue(':isvalidator', $newUser->isValidator(), PDO::PARAM_BOOL);

        if ($this->pseudoAlreadyExist($newUser->getPseudo()))
        {
            return false;
        }

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return true;
    }

    public function pseudoAlreadyExist(string $pseudo)
    {
        $query = $this->connection->prepare('SELECT pseudo, password FROM "user" WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);
        if (count($rows) > 0)
        {
            return true;
        }
        return false;
    }

    public function isLogged()
    {
        if (isset($_COOKIE['pseudo']))
        {
           return false;
        }
        return true;
    }

    public function rememberUser(int $id, string $pseudo)
    {
        if(!isset($_COOKIE['pseudo']))
        {
            setcookie('pseudo', $pseudo, time() + 10 * 24 * 3600, null, null, false, true); // 10 jours
            setcookie('id', strval($id), time() + 10 * 24 * 3600, null, null, false, true); // 10 jours
            return true;
        }
        return false;
    }

    public function checkLogin(string $pseudo, string $password)
    {
        $query = $this->connection->prepare('SELECT pseudo, password FROM "user" WHERE pseudo = :pseudo AND password = :password');
        $query->bindValue(':pseudo', $pseudo);
        $query->bindValue(':password', crypt($password, 'st'));
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);
        if (count($rows) > 0)
        {
            return true;
        }
        return false;
    }

    public function getUser(string $pseudo, string $password)
    {
        $query = $this->connection->prepare('SELECT * FROM "user" WHERE pseudo = :pseudo AND password = :password');
        $query->bindValue(':pseudo', $pseudo);
        $query->bindValue(':password', crypt($password, 'st'));
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);
        if (count($rows) > 0)
        {
            $user = new User();
            $user
                ->setId($rows[0]->id)
                ->setFirstname($rows[0]->firstname)
                ->setIsValidator($rows[0]->isvalidator)
                ->setLastname($rows[0]->lastname)
                ->setBirthday(new DateTimeImmutable($rows[0]->birthday))
                ->setPseudo($rows[0]->pseudo)
                ->setMail($rows[0]->mail)
                ->setPassword($rows[0]->password);
            return $user;
        }
        return false;
    }

    public function findOneById($userId)
    {
        $query = $this->connection->prepare(
            'SELECT * FROM "user" WHERE id = :id');

        $query->bindValue(':id', $userId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ);
        $user = new User();

        $row ? $user
            ->setId($row->id)
            ->setFirstname($row->firstname)
            ->setLastname($row->lastname)
            ->setIsValidator($row->isvalidator)
            ->setBirthday(new DateTimeImmutable($row->birthday))
            ->setPseudo($row->pseudo)
            ->setMail($row->mail)
            ->setPassword($row->password)
            : null;

        return $user;
    }

    public function deleteUser(User $userToDelete)
    {
        $query = $this->connection->prepare('DELETE FROM "user" WHERE id = :id');
        $query->bindValue(':id', $userToDelete->getId());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $result;
    }

    public function updateUser(User $user)
    {
        $query = $this->connection->prepare(
            'UPDATE "user"
            SET firstname = :firstname,
                lastname = :lastname,
                birthday = :birthday,
                pseudo = :pseudo,
                mail = :mail,
                password = :password,
                isvalidator = :isvalidator
            WHERE id = :id');

        $query->bindValue(':id', $user->getId());

        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':lastname', $user->getLastname());
        $query->bindValue(':birthday', $user->getBirthday()->format("Y-m-d"));
        $query->bindValue(':pseudo', $user->getPseudo());
        $query->bindValue(':mail', $user->getMail());
        $query->bindValue(':password', crypt($user->getPassword(), 'st'));
        $query->bindValue(':isvalidator', $user->isValidator(), PDO::PARAM_BOOL);

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }



}
