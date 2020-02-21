<?php

namespace Task;


use DateTimeInterface;
use Exception;
use PDO;
use User\User;

class TaskRepository
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var TaskHydrator
     */
    private TaskHydrator $taskHydrator;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param TaskHydrator $taskHydrator
     */
    public function __construct(PDO $connection, TaskHydrator $taskHydrator)
    {
        $this->connection = $connection;
        $this->taskHydrator = $taskHydrator;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM task')->fetchAll(PDO::FETCH_OBJ);
        $tasks = [];
        foreach ($rows as $row) {
            $task = $this->taskHydrator->hydrateObj($row);
            $tasks[] = $task;
        }

        return $tasks;
    }

    /**
     * @param int $taskId
     * @return Task
     * @throws Exception
     */
    public function findOneById(int $taskId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM task WHERE id = :id');
        $stmt->bindValue(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();
        $rawTask = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->taskHydrator->hydrateObj($rawTask);
    }

    /**
     * @param int $taskId
     */
    public function delete(int $taskId)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM task WHERE id = :id'
        );
        $stmt->bindValue(':id',$taskId,PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param User $creator
     * @param User $assignee
     * @param string $title
     * @param string $content
     * @param int $state
     * @param DateTimeInterface $creationdate
     */
    public function insert(User $creator, User $assignee, string $title, string $content, int $state, DateTimeInterface $creationdate)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO task (idcreator, idassignee, title, content, state, creationdate) 
            VALUES (:idcreator, :idassignee, :title, :content, :state, :creationdate)'
        );

        $stmt->bindValue(':idcreator', $creator->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':idassignee', $assignee->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':title', $title,PDO::PARAM_STR);
        $stmt->bindValue(':content', $content,PDO::PARAM_STR);
        $stmt->bindValue(':state', $state,PDO::PARAM_INT);
        $stmt->bindValue(':creationdate', $creationdate->format("Y-m-d H:i:s"),PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param User $creator
     * @param User $assignee
     * @param string $title
     * @param string $content
     * @param string $state
     */
    public function update(int $id, User $creator, User $assignee, string $title, string $content, string $state)
    {
        $stmt = $this->connection->prepare(
            'UPDATE task SET
                idcreator = :idcreator, 
                idassignee = :idassignee, 
                title = :title, 
                content = :content, 
                state = :state
                WHERE id = :id'
        );

        $stmt->bindValue(':idcreator', $creator->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':idassignee', $assignee->getId(),PDO::PARAM_INT);
        $stmt->bindValue(':title', $title,PDO::PARAM_STR);
        $stmt->bindValue(':content', $content,PDO::PARAM_STR);
        $stmt->bindValue(':state', $state,PDO::PARAM_STR);
        $stmt->bindValue(':id', $id,PDO::PARAM_INT);
        $stmt->execute();
    }

    public function fetchByProject(int $projectId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM task WHERE idproject = :idproj');
        $stmt->bindValue(':idproj', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
        $tasks = [];
        foreach ($rows as $row) {
            $task = $this->taskHydrator->hydrateObj($row);
            $tasks[] = $task;
        }
        return $tasks;
    }
}