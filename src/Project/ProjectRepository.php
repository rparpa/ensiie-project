<?php
namespace Project;

use Exception;
use PDO;


class ProjectRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var ProjectHydrator
     */
    private ProjectHydrator $projectHydrator;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param ProjectHydrator $projectHydrator
     */
    public function __construct(PDO $connection, ProjectHydrator $projectHydrator)
    {
        $this->connection = $connection;
        $this->projectHydrator = $projectHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "project"')->fetchAll(PDO::FETCH_OBJ);
        $projects = [];
        foreach ($rows as $row) {
            $project = $this->projectHydrator->hydrateObj($row);
            $projects[] = $project;
        }

        return $projects;
    }

    /**
     * @param $projectId
     * @return Project
     * @throws Exception
     */
    public function findOneById($projectId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "project" WHERE id = :id');
        $stmt->bindValue(':id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $rawProject = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->projectHydrator->hydrateObj($rawProject);
    }


}
