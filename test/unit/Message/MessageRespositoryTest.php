<?php

namespace Message;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class MessageRepositoryTest extends TestCase
{
    private Object $data, $data2;

    private Message $message, $message2;

    private array $messages;

    private function initData()
    {
        $this->data = new Object_();
        $this->data->id = 2;
        $this->data->iduser = 3;
        $this->data->source = "";
        $this->data->message = "est-ce que c'est toi John Wayne ?";
        $this->data->idsource = 2;
        $this->data->creationdate = "2020-01-20";

        $this->data2 = clone $this->data;
        $this->data2->id = 4;
        $this->data2->message = "ou est-ce que c'est moi ?";

        $this->message = (new MessageHydrator())->hydrateObj($this->data);
        $this->message2 = clone $this->message;
        $this->message2->setId(4);
        $this->message2->setMessage("ou est-ce que c'est moi ?");

        $this->messages[] = $this->data;
        $this->messages[] = $this->data2;        
    }

    /**
    * @test
    */
    public function Test_fetchAll()
        {
        
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
        ->method('fetchAll')
            ->willReturn($this->messages);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new MessageHydrator();
        $repository = new MessageRepository($pdoMock, $hydrator);
        self::assertEquals(2,sizeof($repository->fetchAll()));
    }

    /**
    * @test
    */
    public function Test_fetchByUserId()
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

        $repository = new MessageRepository($pdoMock, new MessageHydrator());
        self::assertEquals(2, $repository->findOneById(2)->getId());
    }

    /**
    * @test
    */
    public function Test_findAllByUserId()
    {
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        


    }


}
