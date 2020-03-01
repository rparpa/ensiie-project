<?php

namespace Info;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class InfoHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function infoIsArray()
    {
        $hydrator = new InfoHydrator();

        $data = ["id"=>1,"source"=>"une source secrete","idsource"=>6,"idcreator"=>3,"title"=>"mon super titre","content"=>"contenu de ouf","creationdate"=>"1999-11-22"];
        
        $infoRef = new Info();
        $infoRef->setId(1);
        $infoRef->setIdsource(6);
        $infoRef->setSource("une source secrete");
        $infoRef->setIdcreator(3);
        $infoRef->setContent("contenu de ouf");
        $infoRef->setTitle("mon super titre");
        $infoRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

        $info = $hydrator->hydrate($data);
        self::assertEquals($infoRef,$info);
    }

}