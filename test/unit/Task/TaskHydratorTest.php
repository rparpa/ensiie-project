<?php

namespace Task;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class TaskHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function Test_TaskIsArray()
    {
        $hydrator = new TaskHydrator();

        $data = ["id"=>1, 
                "title"=>"Appeler George Orwell",
                "idcreator"=>8,
                "content"=>"lui poser des questions",
                "state"=>"todo",
                "idassignee"=>3,
                // "idproject"=>8,
                "creationdate"=>"1999-11-22"];
        
        $taskRef = new Task();
        $taskRef->setId(1);
        $taskRef->setTitle("Appeler George Orwell");
        $taskRef->setIdcreator(8);
        $taskRef->setContent("lui poser des questions");
        $taskRef->setState("todo");
        $taskRef->setIdassignee(3);
        // $taskRef->setIdproject(8);
        $taskRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

        $task = $hydrator->hydrate($data);
        self::assertEquals($taskRef,$task);
    }
}