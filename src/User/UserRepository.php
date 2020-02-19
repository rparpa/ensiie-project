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
                ->setMail($row->mail);

            $users[] = $user;
        }

        return $users;
    }

    public function createUser(User $newUser)
    {
        $query = $this->connection->prepare('INSERT INTO "user"(firstname, lastname, birthday, pseudo, mail) VALUES (:firstname , :lastname, :birthday, :pseudo, :mail)');
        $query->bindValue(':firstname', $newUser->getFirstname());
        $query->bindValue(':lastname', $newUser->getLastname());
        $query->bindValue(':birthday', $newUser->getBirthday()->format("Y-m-d"));
        $query->bindValue(':pseudo', $newUser->getPseudo());
        $query->bindValue(':mail', $newUser->getMail());
        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
    }



}
