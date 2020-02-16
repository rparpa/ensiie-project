<?php
namespace Message;

use DateTimeInterface;
use Exception;
use PDO;
use User\User;


class MessageRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var MessageHydrator
     */
    private MessageHydrator $messageHydrator;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param MessageHydrator $messageHydrator
     */
    public function __construct(PDO $connection, MessageHydrator $messageHydrator)
    {
        $this->connection = $connection;
        $this->messageHydrator = $messageHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM message')->fetchAll(PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $message = $this->messageHydrator->hydrateObj($row);
            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @param $messageId
     * @return Message
     * @throws Exception
     */
    public function findOneById($messageId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM message WHERE id = :id');
        $stmt->bindValue(':id', $messageId, PDO::PARAM_INT);
        $stmt->execute();
        $rawMessage = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->messageHydrator->hydrateObj($rawMessage);
    }


    /**
     * @param $userId
     * @return array
     * @throws Exception
     */
    public function findAllByUserId($userId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM message WHERE iduser = :id');
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $message = $this->messageHydrator->hydrateObj($row);
            $messages[] = $message;
        }
        return $messages;
    }

    /**
     * @param int $messageId
     */
    public function delete(int $messageId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM message WHERE id = :id'
        );
        $stmt->bindValue(':id',$messageId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param User $user
     * @param string $message
     * @param DateTimeInterface $creationdate
     */
    public function insert(User $user, string $source, int $idsoure,  string $message, DateTimeInterface $creationdate)
    {
        //TODO Confirmer la provenance des entrées pour l'insert
        $stmt = $this->connection->prepare(
            'INSERT INTO message (iduser, source, idsource, message, creationdate) 
            VALUES (:iduser, :source, :idsource, :message, :creationdate)'
        );

        $stmt->bindValue(':iduser', $user->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':source', $source,PDO::PARAM_STR);
        $stmt->bindValue(':idsource', $idsoure,PDO::PARAM_INT);
        $stmt->bindValue(':message', $message,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }
}
