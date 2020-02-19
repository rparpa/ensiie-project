<?php


namespace Meeting;


use DateTimeInterface;
use Exception;
use PDO;

class MeetingRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var MeetingHydrator
     */
    private MeetingHydrator $meetingHydrator;

    /**
     * MeetingRepository constructor.
     * @param PDO $connection
     * @param MeetingHydrator $meetingHydrator
     */
    public function __construct(PDO $connection, MeetingHydrator $meetingHydrator)
    {
        $this->connection = $connection;
        $this->meetingHydrator = $meetingHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM meeting')->fetchAll(PDO::FETCH_OBJ);
        $meetings = [];
        foreach ($rows as $row) {
            $meeting = $this->meetingHydrator->hydrateObj($row);
            $meetings[] = $meeting;
        }

        return $meetings;
    }

    public function fetchByUser(int $userId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "meeting" JOIN "usermeeting" ON (meeting.id=usermeeting.idmeeting) WHERE iduser = :iduser');
        $stmt->bindValue(':iduser', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_OBJ);
        $meetings = [];
        if ($rows) {
            foreach ($rows as $row) {
                $meetings[] = [
                    "meeting" => $this->meetingHydrator->hydrateObj($row),
                    "role" => $row->role,
                    "date" => $row->date
                ];
            }
        }
        return $meetings;
    }

    /**
     * @param $meetingId
     * @return Meeting
     * @throws Exception
     */
    public function findOneById($meetingId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM meeting WHERE id = :id');
        $stmt->bindValue(':id', $meetingId, PDO::PARAM_INT);
        $stmt->execute();
        $rawMeeting = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->meetingHydrator->hydrateObj($rawMeeting);
    }

    /**
     * @param int $meetingId
     */
    public function delete(int $meetingId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM meeting WHERE id = :id'
        );
        $stmt->bindValue(':id', $meetingId, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param string $source
     * @param int $idsource
     * @param string $name
     * @param string $place
     * @param string $description
     * @param DateTimeInterface $creationdate
     */
    public function insert(string $source, int $idsource, string $name, string $place, string $description, DateTimeInterface $creationdate)
    {
        //TODO Confirmer la provenance des entrées pour l'insert
        $stmt = $this->connection->prepare(
            'INSERT INTO meeting (source, idsource, name, place, description, creationdate) 
            VALUES (:source, :idsource, :name, :place, :description, :creationdate)'
        );

        $stmt->bindValue(':source', $source, PDO::PARAM_STR);
        $stmt->bindValue(':idsource', $idsource, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':place', $place, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param string $source
     * @param int $idsource
     * @param string $name
     * @param string $place
     * @param string $description
     */
    public function update(int $id, string $source, int $idsource, string $name, string $place, string $description)
    {
        $stmt = $this->connection->prepare(
            'UPDATE meeting SET 
                   source = :source, 
                   idsource = :idsource, 
                   name = :name, 
                   place = :place, 
                   description = :description
                   WHERE id = :id'
        );

        $stmt->bindValue(':source', $source, PDO::PARAM_STR);
        $stmt->bindValue(':idsource', $idsource, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':place', $place, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
