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
        $rows = $this->connection->query('SELECT * FROM "meeting"')->fetchAll(PDO::FETCH_OBJ);
        $meetings = [];
        foreach ($rows as $row) {
            $meeting = $this->meetingHydrator->hydrateObj($row);
            $meetings[] = $meeting;
        }

        return $meetings;
    }

    public function findOneById($meetingId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "meeting" WHERE id = :id');
        $stmt->bindValue(':id', $meetingId, PDO::PARAM_INT);
        $stmt->execute();
        $rawMeeting = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->meetingHydrator->hydrateObj($rawMeeting);
    }
}