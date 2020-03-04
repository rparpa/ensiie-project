<?php

namespace User;
use DateTimeImmutable;
use PDO;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{

    /**
     * @test
     */
    public function createUserTest()
    {
        $newUser = new User();
        $newUser
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
        ->disableOriginalConstructor()
        ->setMethods(['createUser', 'getUserById'])
        ->getMock();

        $expectedUser = new User();
        $expectedUser
            ->setId(1)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        $mockedRepository
            ->method('createUser')
            ->willReturn($expectedUser);

        $mockedRepository
            ->method('getUserById')
            ->willReturn(new User());

        $service = new UserService($mockedRepository);

        self::assertEquals($expectedUser, $service->createUser($newUser));
    }

    /**
 * @test
 */
    public function createUserWithNullIdTest()
    {
        $newUser = new User();
        $newUser
            ->setId(null)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->setMethods(['createUser', 'pseudoAlreadyExist'])
            ->getMock();

        $expectedUser = new User();
        $expectedUser
            ->setId(2)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        $mockedRepository
            ->method('pseudoAlreadyExist')
            ->willReturn(true);

        $mockedRepository
            ->method('createUser')
            ->willReturn(false);

        $service = new UserService($mockedRepository);

        self::assertEquals(false, $service->createUser($newUser));
        self::assertSame('User cannot be created.', $service->getErrors()['user_creation']);
    }

    /**
     * @test
     */
    public function getUserWithNullResultTest()
    {
        $newUser = new User();
        $newUser
            ->setId(99)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);


        $service = new UserService($mockedRepository);

        self::assertEquals(null, $service->getUserById($newUser->getId()));
        self::assertSame('User was not found.', $service->getErrors()['user_fetch']);
    }


    /**
     * @test
     */
    public function getUserTest()
    {
        $newUser = new User();
        $newUser
            ->setId(99)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        $expectedUser = new User();
        $expectedUser
            ->setId(99)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn($expectedUser);


        $service = new UserService($mockedRepository);

        self::assertEquals($expectedUser, $service->getUserById($newUser->getId()));
    }


    /**
     * @test
     */
    public function rememberUserTest()
    {
        $newUser = new User();
        $newUser
            ->setId(99)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");



        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->setMethods(['rememberUser'])
            ->getMock();

        $mockedRepository
            ->method('rememberUser')
            ->willReturn(true);


        $service = new UserService($mockedRepository);

        self::assertEquals(true, $service->rememberUser($newUser->getId(), $newUser->getPseudo()));
    }


    /**
     * @test
     */
    public function rememberUserWithExistingCookieTest()
    {
        $newUser = new User();
        $newUser
            ->setId(99)
            ->setIsValidator(false)
            ->setMail("test@test.test")
            ->setPseudo("test")
            ->setLastname("test")
            ->setFirstname("test")
            ->setBirthday(new DateTimeImmutable('2020-01-01'))
            ->setPassword("test");

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->setMethods(['rememberUser'])
            ->getMock();

        $mockedRepository
            ->method('rememberUser')
            ->willReturn(false);


        $service = new UserService($mockedRepository);

        self::assertEquals(false, $service->rememberUser($newUser->getId(), $newUser->getPseudo()));
        self::assertSame('A user is already connected.', $service->getErrors()['user_login']);
    }
}
