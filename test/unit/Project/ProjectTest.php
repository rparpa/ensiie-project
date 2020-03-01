<?php

namespace Project;

use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /**
    * @test
    */
    public function TestFictiProject()
    {
        $project = new Project();
        $project->setName("construire un pont");
        self::assertSame("construire un pont", $project->getName());
    }
}