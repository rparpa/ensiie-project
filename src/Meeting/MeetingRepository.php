<?php


namespace Meeting;


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
        $stmt->bindValue(':id',$meetingId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param string $name
     * @param string $place
     * @param string $description
     * @param DateTimeInterface $creationdate
     */
    public function insert(string $name, string $place, string $description, DateTimeInterface $creationdate)
    {
        //TODO Confirmer la provenance des entrées pour l'insert
        $stmt = $this->connection->prepare(
            'INSERT INTO meeting (source, idsource, "name", place, description, creationdate) 
            VALUES (:source, :idsource, ":name", :place, :description, :creationdate)'
        );

//        $stmt->bindValue(':source', ,PDO::PARAM_INT);
//        $stmt->bindValue(':idsource', ,PDO::PARAM_INT);
        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':place', $place,PDO::PARAM_STR);
        $stmt->bindValue(':description', $description,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();

    }
}