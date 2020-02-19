<?php
namespace Project;

use DateTimeInterface;
use Exception;
use Organization\Organization;
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
        $rows = $this->connection->query('SELECT * FROM project')->fetchAll(PDO::FETCH_OBJ);
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
        $stmt = $this->connection->prepare('SELECT * FROM project WHERE id = :id');
        $stmt->bindValue(':id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $rawProject = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->projectHydrator->hydrateObj($rawProject);
    }

    /**
     * @param int $projectId
     */
    public function delete(int $projectId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM project WHERE id = :id'
        );
        $stmt->bindValue(':id',$projectId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param string $name
     * @param Organization $organization
     * @param DateTimeInterface $creationdate
     */
    public function insert(string $name, Organization $organization, DateTimeInterface $creationdate)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO project (name, idorganization, creationdate) 
            VALUES (:name, :idorganization, :creationdate)'
        );

        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':idorganization', $organization->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param string $name
     * @param Organization $organization
     */
    public function update(int $id, string $name, Organization $organization)
    {
        $stmt = $this->connection->prepare(
            'UPDATE project SET name = :name, idorganization =:idorganization WHERE id =:id'
        );

        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':idorganization', $organization->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':id', $id,PDO::PARAM_INT);
        $res = $stmt->execute();
    }
}
