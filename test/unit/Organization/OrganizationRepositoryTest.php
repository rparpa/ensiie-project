<?php


namespace Organization;


use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class OrganizationRepositoryTest extends TestCase
{
    private Object $data, $data2;

    private Organization $organization, $organization2;

    private array $organizations;

    private function initData() {
        $this->data = new Object_();
        $this->data->id = 1;
        $this->data->name = 'Ile Mystérieuse';
        $this->data->creationdate = '2000-11-22';

        $this->data2 = clone $this->data;
        $this->data2->id = 2;

        $this->organization = (new OrganizationHydrator())->hydrateObj($this->data);
        $this->organization2 = clone $this->organization;
        $this->organization2->setId(2);

        $this->organizations[] = $this->data;
        $this->organizations[] = $this->data2;
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
            ->willReturn($this->organizations);

        $pdoMock->method('query')
            ->willReturn($stmtMock);

        $hydrator = new OrganizationHydrator();
        $repository = new OrganizationRepository($pdoMock, $hydrator);
        self::assertEquals(2,sizeof($repository->fetchAll()));
    }
}