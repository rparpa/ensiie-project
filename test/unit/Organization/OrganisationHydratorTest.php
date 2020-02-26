<?php


namespace Organization;

use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;


class OrganizationHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function organisationIsArray()
    {
        $hydrator = new OrganizationHydrator();
        $data = [ "id"=>2, "name"=>"bobby", "creationdate"=>"2020-02-12"];

        $orgaRef = new Organization();
        $orgaRef->setId(2);
        $orgaRef->setName("bobby");
        $orgaRef->setCreationdate(new \DateTimeImmutable('2020-02-12'));

        $orga = $hydrator->hydrate($data);
        self::assertEquals($orgaRef,$orga);
    }

    /**
     * @test
     */
    public function organisationIsObject()
    {
        $hydrator = new OrganizationHydrator();
        
        $data = new Object_();
        $data->id = 2;
        $data->name = "bobby";
        $data->creationdate = "2020-02-12";

        $orgaRef = new Organization();
        $orgaRef->setId(2);
        $orgaRef->setName("bobby");
        $orgaRef->setCreationdate(new \DateTimeImmutable('2020-02-12'));

        $orga = $hydrator->hydrateObj($data);
        self::assertEquals($orgaRef,$orga);




    }


}