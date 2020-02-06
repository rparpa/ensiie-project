<?php


namespace User;

use Exception;
use \User\User as UserEntity;

class UserHydrator
{
    /**
     * @param $data
     * @return User
     * @throws Exception
     */
    public function hydrate($data): UserEntity
    {
        $user = new UserEntity();
        $user
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setSurname($data['surname'])
            ->setName($data['name'])
            ->setMail($data['mail'])
            ->setPassword($data['password'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $user;
    }

    /**
     * @param $data
     * @return User
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $user = new UserEntity();
        $user
            ->setId($data->id)
            ->setUsername($data->username)
            ->setSurname($data->surname)
            ->setName($data->name)
            ->setMail($data->mail)
            ->setPassword($data->password)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $user;
    }
}