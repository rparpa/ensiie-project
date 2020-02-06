<?php


namespace Info;

use Exception;
use PDO;

class InfoRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var InfoHydrator
     */
    private InfoHydrator $infoHydrator;

    /**
     * InfoRepository constructor.
     * @param PDO $connection
     * @param InfoHydrator $infoHydrator
     */
    public function __construct(PDO $connection, InfoHydrator $infoHydrator)
    {
        $this->connection = $connection;
        $this->infoHydrator = $infoHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "info"')->fetchAll(PDO::FETCH_OBJ);
        $infos = [];
        foreach ($rows as $row) {
            $info = $this->infoHydrator->hydrateObj($row);
            $infos[] = $info;
        }
        return $infos;
    }

    public function findOneById($infoId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "info" WHERE id = :id');
        $stmt->bindValue(':id', $infoId, PDO::PARAM_INT);
        $stmt->execute();
        $rawInfo = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->infoHydrator->hydrateObj($rawInfo);
    }
}