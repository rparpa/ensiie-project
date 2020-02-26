<?php

namespace User;


use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class UserHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function UserIsArray()
    {
        $hydrator = new UserHydrator();
        $data = ['id'=>1, 'username'=>'JD', 'surname'=>'John', 'name'=>'Doe',
            'mail'=>'j.d@hl.com', 'password'=>'JD', 'creationdate'=>'1967-11-22'];

        $userRef = new User();
        $userRef->setId(1);
        $userRef->setUsername('JD');
        $userRef->setSurname('John');
        $userRef->setName('Doe');
        $userRef->setMail('j.d@hl.com');
        $userRef->setPassword('JD');
        $userRef->setCreationdate(new \DateTimeImmutable('1967-11-22'));

        $user = $hydrator->hydrate($data);
        self::assertEquals($userRef ,$user);
    }

    /**
     * @test
     */
    public function UserIsAObjet()
    {
        $hydrator = new UserHydrator();
        $data = new Object_();
        $data->id = 1;
        $data->username ='JD';
        $data->surname = 'John';
        $data->name = 'Doe';
        $data->mail = 'j.d@hl.com';
        $data->password = 'JD';
        $data->creationdate = '1967-11-22';

        $userRef = new User();
        $userRef->setId(1);
        $userRef->setUsername('JD');
        $userRef->setSurname('John');
        $userRef->setName('Doe');
        $userRef->setMail('j.d@hl.com');
        $userRef->setPassword('JD');
        $userRef->setCreationdate(new \DateTimeImmutable('1967-11-22'));

        $user = $hydrator->hydrateObj($data);
        self::assertEquals($userRef,$user);
    }
}