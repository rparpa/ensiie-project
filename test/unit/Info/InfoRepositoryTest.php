<?php

namespace Info; 
// namespace GenericRepositoryDB;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

// interface DBInterface
// {
//     public function paramQuery($query, array $params = []): DBInterface;
//     public function getSingleArray(): array;
//     // ...
// }

class InfoRepositoryTest extends TestCase
{
    private Object $data, $data2, $data3;

    private Info $info, $info2;

    private array $infos;

    private function initData()
    {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->source = "une source";
        $this->data->idsource = 4;
        $this->data->idcreator = 2;
        $this->data->title = "premier titre";
        $this->data->content = "un contenu random";
        $this->data->creationdate = "2020-01-20";

        $this->data2 = new Object_();
        $this->data2->id = 2;
        $this->data2->source = "une autre source";
        $this->data2->idsource = 3;
        $this->data2->idcreator = 9;
        $this->data2->title = "deuxieme titre";
        $this->data2->content = "un autre contenu random";
        $this->data2->creationdate = "2019-01-20";

        $this->data3 = new Object_();
        $this->data3->id = 3;
        $this->data3->source = "une autre source";
        $this->data3->idsource = 3;
        $this->data3->idcreator = 10;
        $this->data3->title = "deuxieme titre bis";
        $this->data3->content = "un autre contenu random bis";
        $this->data3->creationdate = "2019-01-20";

        $this->info = (new InfoHydrator())->hydrateObj($this->data);
        $this->info2 = (new InfoHydrator())->hydrateObj($this->data2);
        $this->info3 = (new InfoHydrator())->hydrateObj($this->data3);

        $this->infos[] = $this->data;
        $this->infos[] = $this->data2;
        $this->infos[] = $this->data3;
    }

    /**
    * @test
    */
    public function Test_fetch1l()
    {
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
        ->method('fetchAll')
            ->willReturn($this->infos);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new InfoHydrator();
        $repository = new InfoRepository($pdoMock, $hydrator);
        self::assertEquals(3,sizeof($repository->fetchAll()));
    }

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

        $repository = new InfoRepository($pdoMock, new InfoHydrator());
        self::assertEquals(1, $repository->findOneById(1)->getId());
    }
    /**
    * @test
    */
    // public function Test_fetchBySource()
    // {
    //     $stmtMock = $this->createMock(\PDOStatement::class);
    //     $pdoMock = $this->createMock(\PDO::class);

    //     $this->initData();

    //     $stmtMock
    //         ->method('bindValue');
    //     $stmtMock
    //         ->method('execute');
    //     $stmtMock
    //     ->method('fetchAll')
    //         ->willReturn($this->infos);
    //     $pdoMock->method('query')
    //         ->willReturn($stmtMock);


    //     $repository = new InfoRepository($pdoMock, new InfoHydrator());
        
    //     var_dump($repository->fetchBySource("une autre source",3));

    //     self::assertEquals(2,sizeof(($repository->fetchBySource("une autre source",3))));
    // }
}