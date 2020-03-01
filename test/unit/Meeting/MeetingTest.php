<?php

namespace Meeting;

use PHPUnit\Framework\TestCase;

class MeetingTest extends TestCase
{
     /**
    * @test
    */
    public function TestFictiMeeting()
    {
        $meeting = new Meeting();
        $meeting->setName("prise de la Bastille");
        self::assertSame("prise de la Bastille", $meeting->getName("prise de la Bastille"));
    }
}