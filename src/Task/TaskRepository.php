<?php

namespace Task;


use Exception;
use PDO;
use Task;

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
        $rows = $this->connection->query('SELECT * FROM "task"')->fetchAll(PDO::FETCH_OBJ);
        $tasks = [];
        foreach ($rows as $row) {
            $task = $this->taskHydrator->hydrateObj($row);
            $tasks[] = $task;
        }

        return $tasks;
    }

    /**
     * @param $taskId
     * @return Task
     * @throws Exception
     */
    public function findOneById($taskId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "organization" WHERE id = :id');
        $stmt->bindValue(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();
        $rawTask = $stmt->fetch(PDO::FETCH_OBJ);
        return $this->taskHydrator->hydrateObj($rawTask);
    }
}