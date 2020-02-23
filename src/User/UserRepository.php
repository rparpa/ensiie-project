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

    public function fetchByOrganization(int $orgId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" JOIN userorganization ON ("user".id=userorganization.iduser) WHERE idorganization = :idorg');
        $stmt->bindValue(':idorg', $orgId, PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $users[] = [
                "user" => $this->userHydrator->hydrateObj($row),
                "role" => $row->role,
                "date" => $row->date
            ];
        }
        return $users;
    }

    public function fetchByOrganizationNotInProject(int $projId)
    {
        //TODO Voir pour faire mieux
        $stmt = $this->connection->
            prepare('SELECT * FROM "user" 
                                JOIN userproject ON ("user".id = userproject.iduser)
                                WHERE id NOT IN (
                                SELECT id FROM "user" 
                                JOIN userproject ON ("user".id = userproject.iduser) 
                                WHERE idproject = :idproj)');
        $stmt->bindValue(':idproj', $projId, PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $users[] = [
                "user" => $this->userHydrator->hydrateObj($row),
                "role" => $row->role,
                "date" => $row->date
            ];
        }
        return $users;
    }

    public function fetchByProject(int $projectId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" JOIN userproject ON ("user".id=userproject.iduser) WHERE idproject = :idproj');
        $stmt->bindValue(':idproj', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $users[] = [
                "user" => $this->userHydrator->hydrateObj($row),
                "role" => $row->role,
                "date" => $row->date
            ];
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
        if (!$rawUser){
            throw new Exception('Aucun utilisateur.');
        }
        return $this->userHydrator->hydrateObj($rawUser);
    }

    /**
     * @param string $username
     * @return User
     * @throws Exception
     */
    public function findOneByUsername(string $username)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" WHERE username = :username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rawUser = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawUser){
            return null;
        }
        return $this->userHydrator->hydrateObj($rawUser);
    }

    /**
     * @param string $mail
     * @return User
     * @throws Exception
     */
    public function findOneByMail(string $mail)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" WHERE mail = :mail');
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $rawUser = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawUser){
            return null;
        }
        return $this->userHydrator->hydrateObj($rawUser);
    }

    /**
     * @param int $userId
     */
    public function delete(int $userId)
    {
        //TODO : Doit on également le supprimer des réunions(voir les réunions elles meme)
        // dont il est l'organisateur et également le supprimer des réunions dont il est simple participant.
        // et pour les messages/Infos/Tasks??
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
            'INSERT INTO "user" (username, surname, name, mail, password, creationdate) 
            VALUES (:username, :surname, :name, :mail, :password, :creationdate)'
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
                    password = :password
                    WHERE id = :id'
            );
            $stmt->bindValue(':username', $username,PDO::PARAM_STR);
            $stmt->bindValue(':surname', $surname,PDO::PARAM_STR);
            $stmt->bindValue(':name', $name,PDO::PARAM_STR);
            $stmt->bindValue(':mail', $mail,PDO::PARAM_STR);
            $stmt->bindValue(':password', $password,PDO::PARAM_STR);
            $stmt->bindValue(':id', $id,PDO::PARAM_INT);
            $res = $stmt->execute();
        }
    }
}
