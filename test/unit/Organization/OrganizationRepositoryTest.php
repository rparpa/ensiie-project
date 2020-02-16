<?php


namespace Organization;


use PHPUnit\Framework\TestCase;

class OrganizationRepositoryTest extends TestCase
{
    public function test()
    {
        $organization = $this->createMock(Organization::class);
        $organization->method('getId')
            ->willReturn(1);
        $hydrator = $this->createMock(OrganizationHydrator::class);
        $hydrator->method("hydrate")
            ->willReturn($organization);

        $pdo = $this->$this->createMock(\PDO::class);
        $pdo->method('query');

        $repository = new OrganizationRepository($pdo, $hydrator);

        $result = $repository->findOneById(1);

    }
}