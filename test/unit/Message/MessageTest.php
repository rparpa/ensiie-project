<?php
namespace Message;

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /**
     * @test
     */
    public function TestFictifMessage()
    {
        $message = new Message();
        $message->setMessage("Message Test");
        self::assertSame("Message Test", $message->getMessage());
    }


}
