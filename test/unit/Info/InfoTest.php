<?php

namespace Info;

use PHPUnit\Framework\TestCase;

class InfoTest extends TestCase
{
     /**
    * @test
    */
    public function TestFictiInfo()
    {
        $info = new Info();
        $info->setContent("info test");
        self::assertSame("info test", $info->getContent());
    }
}
