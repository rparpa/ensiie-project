<?php
namespace User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function TestFictifUser()
    {
        $user = new User();
        $user->setUsername("J.D");
        self::assertSame("J.D", $user->getUsername());
    }


}
