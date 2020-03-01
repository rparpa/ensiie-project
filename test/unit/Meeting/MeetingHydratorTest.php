<?php

namespace Meeting;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class MeetingHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function Test_meetingIsArray()
    {
        $hydrator = new MeetingHydrator();

        $data = ["id"=>1, "name"=>"Proudhon", "source"=>"", "idsource"=>1, "place"=>"over the rainbow","description"=>"euhhhh", "creationdate"=>"1999-11-22"];
        
        $meetingRef = new Meeting();
        $meetingRef->setId(1);
        $meetingRef->setName("Proudhon");
        $meetingRef->setSource("");
        $meetingRef->setIdsource(1);
        $meetingRef->setPlace("over the rainbow");
        $meetingRef->setDescription("euhhhh");
        $meetingRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

        $meeting = $hydrator->hydrate($data);
        self::assertEquals($meetingRef,$meeting);
    }
}