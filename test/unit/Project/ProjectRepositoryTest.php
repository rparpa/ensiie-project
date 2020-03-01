<?php


namespace Project;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

class ProjectRepositoryTest extends TestCase
{
    private Object $data, $data2;

    private Project $project, $project2;

    private array $projects;

    private function initData() {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->idorganization =4;
        $this->data->name = 'to the moon';
        $this->data->creationdate = '2018-11-22';

        $this->data2 = clone $this->data;
        $this->data2->id = 2;
        $this->data2->name = 'to Mars';

        $this->project = (new ProjectHydrator())->hydrateObj($this->data);
        $this->project2 = clone $this->project;
        $this->project2->setId(2);
        $this->project2->setName('to Mars');

        $this->projects[] = $this->data;
        $this->projects[] = $this->data2;
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

        $repository = new ProjectRepository($pdoMock, new ProjectHydrator());
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
                ->willReturn($this->projects);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new ProjectHydrator();
        $repository = new ProjectRepository($pdoMock, $hydrator);
        self::assertEquals(2,sizeof($repository->fetchAll()));
    }
}