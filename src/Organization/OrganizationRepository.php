<?php
namespace Organization;

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
        $rows = $this->connection->query('SELECT * FROM "organization"')->fetchAll(PDO::FETCH_OBJ);
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
        $stmt = $this->connection->prepare('SELECT * FROM "organization" WHERE id = :id');
        $stmt->bindValue(':id', $organizationId, PDO::PARAM_INT);
        $stmt->execute();
        $rawOrganization = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->organizationHydrator->hydrateObj($rawOrganization);
    }


}
