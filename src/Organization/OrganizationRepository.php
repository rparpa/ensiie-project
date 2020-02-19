<?php
namespace Organization;

use DateTimeInterface;
use Exception;
use PDO;

class OrganizationRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var OrganizationHydrator
     */
    private OrganizationHydrator $organizationHydrator;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param OrganizationHydrator $organizationHydrator
     */
    public function __construct(PDO $connection, OrganizationHydrator $organizationHydrator)
    {
        $this->connection = $connection;
        $this->organizationHydrator = $organizationHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM organization')->fetchAll(PDO::FETCH_OBJ);
        $organizations = [];
        foreach ($rows as $row) {
            $organization = $this->organizationHydrator->hydrateObj($row);
            $organizations[] = $organization;
        }

        return $organizations;
    }

    /**
     * @param $organizationId
     * @return Organization
     * @throws Exception
     */
    public function findOneById($organizationId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM organization WHERE id = :id');
        $stmt->bindValue(':id', $organizationId, PDO::PARAM_INT);
        $stmt->execute();
        $rawOrganization = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawOrganization){
            return null;
        }
        return $this->organizationHydrator->hydrateObj($rawOrganization);
    }

    /**
     * @param $nameorga
     * @return Organization|null
     * @throws Exception
     */
    public function findOneByName($nameorga)
    {
        $stmt = $this->connection->prepare('SELECT * FROM organization WHERE name = :name');
        $stmt->bindValue(':name', $nameorga, PDO::PARAM_STR);
        $stmt->execute();
        $rawOrganization = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawOrganization){
            return null;
        }
        return $this->organizationHydrator->hydrateObj($rawOrganization);
    }

    /**
     * @param int $organizationId
     */
    public function delete(int $organizationId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM organization WHERE id = :id'
        );
        $stmt->bindValue(':id',$organizationId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param string $name
     * @param DateTimeInterface $creationdate
     */
    public function insert(string $name, DateTimeInterface $creationdate)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO organization (name, creationdate) 
            VALUES (:name, :creationdate)'
        );

        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function update(int $id, string $name)
    {
        $stmt = $this->connection->prepare(
            'UPDATE organization SET name = :name WHERE id = :id'
        );

        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':id', $id,PDO::PARAM_INT);
        $stmt->execute();
    }
}
