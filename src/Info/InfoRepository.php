<?php


namespace Info;

use DateTimeInterface;
use Exception;
use PDO;
use User\User;

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
        $rows = $this->connection->query('SELECT * FROM info')->fetchAll(PDO::FETCH_OBJ);
        $infos = [];
        foreach ($rows as $row) {
            $info = $this->infoHydrator->hydrateObj($row);
            $infos[] = $info;
        }
        return $infos;
    }

    /**
     * @param int $infoId
     * @return Info
     * @throws Exception
     */
    public function findOneById(int $infoId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM info WHERE id = :id');
        $stmt->bindValue(':id', $infoId, PDO::PARAM_INT);
        $stmt->execute();
        $rawInfo = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->infoHydrator->hydrateObj($rawInfo);
    }

    /**
     * @param int $infoId
     */
    public function delete(int $infoId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM info WHERE id = :id'
        );
        $stmt->bindValue(':id',$infoId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param User $creator
     * @param string $title
     * @param string $content
     * @param DateTimeInterface $creationdate
     * @param Object $source
     */
    public function insert(User $creator, string $title, string $content, DateTimeInterface $creationdate, Object $source)
    {
        
        $stmt = $this->connection->prepare(
            'INSERT INTO info (source, idsource, idcreator, title, content, creationdate) 
            VALUES (:source, :idsource, :idcreator, :title, :content, :creationdate)'
        );

        $stmt->bindValue(':source', $source->getTable(),PDO::PARAM_STR);
        $stmt->bindValue(':idsource', $source->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':idcreator', $creator->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':title', $title,PDO::PARAM_STR);
        $stmt->bindValue(':content', $content,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }

    public function fetchBySource(string $source, int $sourceId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM info WHERE source = :nmsrc AND idsource = :idsrc');
        $stmt->bindValue(':nmsrc', $source, PDO::PARAM_STR);
        $stmt->bindValue(':idsrc', $sourceId, PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetch(PDO::FETCH_OBJ);
        $infos = [];
        foreach ($rows as $row) {
            $info = $this->infoHydrator->hydrateObj($row);
            $infos[] = $info;
        }
        return $infos;
    }

}