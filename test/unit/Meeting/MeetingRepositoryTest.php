<?php

namespace Meeting; 

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;


class MeetingRepositoryTest extends TestCase
{
    private Object $data, $data2, $data3;

    private Meeting $meeting, $meeting2, $meeting3;

    private array $meetings;

    private function initData()
    {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->source = "une source";
        $this->data->idsource = 4;
        $this->data->name = "surfer";
        $this->data->place = "Borneo";
        $this->data->description = "une plage";
        $this->data->creationdate = "2020-01-20";

        $this->data2 = new Object_();
        $this->data2->id = 2;
        $this->data2->source = "une source";
        $this->data2->idsource = 5;
        $this->data2->name = "nager";
        $this->data2->place = "Bretagne";
        $this->data2->description = "une autre plage";
        $this->data2->creationdate = "2020-01-20";

        $this->data3 = new Object_();
        $this->data3->id = 3;
        $this->data3->source = "une source";
        $this->data3->idsource = 4;
        $this->data3->name = "snorkling";
        $this->data3->place = "Majorque";
        $this->data3->description = "une superbe plage";
        $this->data3->creationdate = "2020-01-20";

        $this->info = (new MeetingHydrator())->hydrateObj($this->data);
        $this->info2 = (new MeetingHydrator())->hydrateObj($this->data2);
        $this->info3 = (new MeetingHydrator())->hydrateObj($this->data3);

        $this->messages[] = $this->data;
        $this->messages[] = $this->data2;
        $this->messages[] = $this->data3;
    }

    /**
    * @test
    */
    // public function Test_fetchA1l()
    // {
    //     $stmtMock = $this->createMock(\PDOStatement::class);
    //     $pdoMock = $this->createMock(\PDO::class);

    //     $this->initData();

    //     $stmtMock
    //     ->method('fetchAll')
    //         ->willReturn($this->meetings);

    //     $pdoMock->method('query')
    //         ->willReturn($stmtMock);


    //     $hydrator = new MeetingHydrator();
    //     $repository = new MeetingRepository($pdoMock, $hydrator);
    //     self::assertEquals(3,sizeof($repository->fetchAll()));
    // }

    /**
    * @test
    */
    public function Test_findOneById()
    {
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

        $repository = new MeetingRepository($pdoMock, new MeetingHydrator());
        self::assertEquals(1, $repository->findOneById(1)->getId());
    }
}