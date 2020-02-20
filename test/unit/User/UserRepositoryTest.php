<?php


namespace User;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private Object $data, $data2;

    private User $user, $user2;

    private array $users;

    private function initData() {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->username ='JD';
        $this->data->surname = 'John';
        $this->data->name = 'Doe';
        $this->data->mail = 'j.d@hl.com';
        $this->data->password = 'JD';
        $this->data->creationdate = '1967-11-22';

        $this->data2 = clone $this->data;
        $this->data2->id = 2;

        $this->user = (new UserHydrator())->hydrateObj($this->data);
        $this->user2 = clone $this->user;
        $this->user2->setId(2);

        $this->users[] = $this->data;
        $this->users[] = $this->data2;
    }
    /**
     * @test
     */
    public function Test_findOneById_Nominal(){
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

        $repository = new UserRepository($pdoMock, new UserHydrator());
        self::assertEquals(1, $repository->findOneById(1)->getId());
    }

    /**
     * @test
     */
    public function Test_findOneById_Exception(){
        // Create test doubles.
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
            ->method('bindValue');
        $stmtMock
            ->method('execute');
        $stmtMock
            ->method('fetch');
        $pdoMock->method('prepare')
            ->willReturn($stmtMock);

        $repository = new UserRepository($pdoMock, new UserHydrator());
        self::expectExceptionMessage("Aucun utilisateur.");
        $repository->findOneById(1);
    }

    /**
     * @test
     */
    public function Test_fetchAll_Nominal(){
        // Create test doubles.
        $stmtMock = $this->createMock(\PDOStatement::class);
        $pdoMock = $this->createMock(\PDO::class);

        $this->initData();

        $stmtMock
            ->method('fetchAll')
                ->willReturn($this->users);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new UserHydrator();
        $repository = new UserRepository($pdoMock, $hydrator);
        self::assertEquals(2,sizeof($repository->fetchAll()));
    }

}