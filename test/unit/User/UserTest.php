<?php
namespace User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function ageWhenBirthdayInThePast()
    {
        $user = new User();
        $user->setBirthday(new \DateTime('-10 years'));
        self::assertSame(10, $user->getAge());
    }

    /**
     * @test
     */
    public function ageWhenBirthdayNow()
    {
        $user = new User();
        $user->setBirthday(new \DateTime());
        self::assertSame(0, $user->getAge());
    }

    /**
     * @test
     */
    public function ageWhenBirthdayInTheFuture()
    {
        $user = new User();
        $user->setBirthday(new \DateTime('+10 years'));
        $this->expectException(\OutOfRangeException::class);
        $user->getAge();
    }
}
