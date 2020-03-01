<?php

namespace Task;

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    /**
    * @test
    */
    public function TestFictiTask()
    {
        $project = new Task();
        $project->setContent("construire un pont");
        self::assertSame("construire un pont", $project->getContent());
    }
}