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

            $users[] = $user;
        }

        return $users;
    }

    public function createUser(User $newUser)
    {
        $query = $this->connection->prepare('INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail, password) VALUES (:firstname , :lastname, :birthday, :pseudo, :mail, :password)');
        $query->bindValue(':firstname', $newUser->getFirstname());
        $query->bindValue(':lastname', $newUser->getLastname());
        $query->bindValue(':birthday', $newUser->getBirthday()->format("Y-m-d"));
        $query->bindValue(':pseudo', $newUser->getPseudo());
        $query->bindValue(':mail', $newUser->getMail());
        $query->bindValue(':password', crypt($newUser->getPassword(), 'st'));

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
                ->setLastname($rows[0]->lastname)
                ->setBirthday(new DateTimeImmutable($rows[0]->birthday))
                ->setPseudo($rows[0]->pseudo)
                ->setMail($rows[0]->mail)
                ->setPassword($rows[0]->password);
            return $user;
        }
        return false;
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



}
