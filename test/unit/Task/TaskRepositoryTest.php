<?php


namespace Task;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

class TaskRepositoryTest extends TestCase
{
    private Object $data, $data2;

    private Task $task, $task2;

    private array $tasks;

    private function initData() {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->title ="ameliorer les cookies";
        $this->data->content = 'remuer la pâte';
        $this->data->state = "terminé";
        $this->data->idcreator = 6;
        $this->data->idassignee = 12;
        $this->data->idproject = 5;
        $this->data->creationdate = '2018-11-22';

        $this->data2 = clone $this->data;
        $this->data2->id = 2;
        $this->data2->title = 'relancer les clients';

        $this->task = (new TaskHydrator())->hydrateObj($this->data);
        $this->task2 = clone $this->task;
        $this->task2->setId(2);
        $this->task2->setTitle('relancer les clients');

        $this->tasks[] = $this->data;
        $this->tasks[] = $this->data2;
    }
    /**
     * @test
     */
    public function Test_findOneById(){
        // Create test doubles.
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
            ->method('bindValue');
        $stmtMock
            ->method('execute');
        $stmtMock
            ->method('fetch')
        ->willReturn($this->data);
        $pdoMock->method('prepare')
            ->willReturn($stmtMock);

        $repository = new TaskRepository($pdoMock, new TaskHydrator());
        self::assertEquals(1, $repository->findOneById(1)->getId());
    }

    /**
     * @test
     */
    public function Test_fetchAll(){
        // Create test doubles.
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
            ->method('fetchAll')
                ->willReturn($this->tasks);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new TaskHydrator();
        $repository = new TaskRepository($pdoMock, $hydrator);
        self::assertEquals(2,sizeof($repository->fetchAll()));
    }
}