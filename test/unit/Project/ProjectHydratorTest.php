<?php

namespace Project;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class ProjectHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function Test_meetingIsArray()
    {
        $hydrator = new ProjectHydrator();

        $data = ["id"=>1, "name"=>"Proudhon", "idorganization"=>8,"creationdate"=>"1999-11-22"];
        
        $projectRef = new Project();
        $projectRef->setId(1);
        $projectRef->setName("Proudhon");
        $projectRef->setIdorganization(8);
        $projectRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

        $project = $hydrator->hydrate($data);
        self::assertEquals($projectRef,$project);
    }
}