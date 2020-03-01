<?php
namespace Project;

use DateTimeImmutable;
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
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function fetchByUser(int $userId)
    {
        //return $this->fetchByUserByRole($userId, "Larbin");

        $stmt = $this->connection->prepare(
            'SELECT * FROM project JOIN userproject ON (project.id=userproject.idproject) 
                        WHERE iduser = :iduser');
        $stmt->bindValue(':iduser', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $projects = [];
        if ($rows) {
            foreach ($rows as $row) {
                $projects[] = [
                    "project" => $this->projectHydrator->hydrateObj($row),
                    "role" => $row->role,
                    "date" => $row->date
                ];
            }
        }
        return $projects;
    }

    /**
     * @param int $userId
     * @param string $role
     * @return array
     * @throws Exception
     */
    public function fetchByUserByRole(int $userId, string $role){
        $stmt = $this->connection->prepare(
            'SELECT * FROM project JOIN userproject ON (project.id=userproject.idproject) 
                        WHERE iduser = :iduser AND role = :role');
        $stmt->bindValue(':iduser', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $projects = [];
        if ($rows) {
            foreach ($rows as $row) {
                $projects[] = [
                    "project" => $this->projectHydrator->hydrateObj($row),
                    "role" => $row->role,
                    "date" => $row->date
                ];
            }
        }
        return $projects;
    }

    /**
     * @param int $idproject
     * @return bool
     */
    public function hasResponableByIdProject(int $idproject){
        $stmt = $this->connection->prepare(
            'SELECT count(*) FROM project JOIN userproject ON (project.id=userproject.idproject) 
                        WHERE role = :role AND idproject = :idproject;');
        $stmt->bindValue(':idproject', $idproject, PDO::PARAM_INT);
        $stmt->bindValue(':role', 'Chef', PDO::PARAM_STR);
        $stmt->execute();
        $nb = $stmt->fetch();
        return ($nb['count'] > 0);
    }

    /**
     * @param $idorganization
     * @return array
     * @throws Exception
     */
    public function fetchByIdOrganization($idorganization)
    {
        $stmt = $this->connection->prepare('SELECT * FROM project WHERE idorganization = :idorganization');
        $stmt->bindValue(':idorganization', $idorganization, PDO::PARAM_INT);
        $stmt->execute();
        $rawProject = $stmt->fetchAll(PDO::FETCH_OBJ);
        $projects = [];
        foreach ($rawProject as $row) {
            $project = $this->projectHydrator->hydrateObj($row);
            $projects[] = $project;
        }

        return $projects;
    }

    /**
     * @param $projectId
     * @return Project|null
     * @throws Exception
     */
    public function findOneById($projectId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM project WHERE id = :id');
        $stmt->bindValue(':id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $rawProject = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawProject){
            return null;
        }
        return $this->projectHydrator->hydrateObj($rawProject);
    }

    /**
     * @param $projectName
     * @return Project|null
     * @throws Exception
     */
    public function findOneByName($projectName)
    {
        $stmt = $this->connection->prepare('SELECT * FROM project WHERE name = :name');
        $stmt->bindValue(':name', $projectName, PDO::PARAM_STR);
        $stmt->execute();
        $rawProject = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$rawProject){
            return null;
        }
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
        $res = $stmt->execute();
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

    /**
     * @param int $iduser
     * @param int $idproject
     * @param string $role
     * @throws Exception
     */
    public function addUser(int $iduser, int $idproject, string $role){
        $stmt = $this->connection->prepare(
            'INSERT INTO userproject (iduser, idproject, role, date) 
            VALUES (:iduser, :idproject, :role, :creationdate)'
        );
        $stmt->bindValue(':iduser', $iduser,PDO::PARAM_INT);
        $stmt->bindValue(':idproject', $idproject,PDO::PARAM_INT);
        $stmt->bindValue(':role', $role,PDO::PARAM_STR);
        $stmt->bindValue(':creationdate', (new DateTimeImmutable("now"))->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $res = $stmt->execute();
    }

    /**
     * @param int $iduser
     * @param int $idproject
     */
    public function deleteUser(int $iduser, int $idproject){
        $stmt = $this->connection->prepare(
            'DELETE FROM userproject WHERE iduser = :iduser AND idproject = :idproject'
        );
        $stmt->bindValue(':iduser', $iduser,PDO::PARAM_INT);
        $stmt->bindValue(':idproject', $idproject,PDO::PARAM_INT);
        $res = $stmt->execute();
        if(!$res)
            var_dump($stmt->errorInfo());
    }
}
