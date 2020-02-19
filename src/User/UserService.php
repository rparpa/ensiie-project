<?php
namespace User;
use DateTimeImmutable;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $newUser)
    {
        $result = $this->userRepository->createUser($newUser);

        return $result;
    }

    public function getAllUser()
    {
        $result = $this->userRepository->fetchAll();

        return $result;
    }

    public function deleteUser(User $userToDelete)
    {
        $result = $this->deleteUser($userToDelete);
        return $result;
    }
}
