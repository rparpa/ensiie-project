<?php
namespace User;
use DateTimeImmutable;
use Exception;

/**
 * Class UserService
 * @package User
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $newUser
     * @return bool
     */
    public function createUser(User $newUser)
    {
        $result = $this->userRepository->createUser($newUser);

        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllUser()
    {
        $result = $this->userRepository->fetchAll();

        return $result;
    }

    /**
     * @param User $userToDelete
     * @return bool
     */
    public function deleteUser(User $userToDelete)
    {
        $result = $this->userRepository->deleteUser($userToDelete);
        return $result;
    }

    /**
     * @param string $pseudo
     * @param string $password
     * @return bool
     */
    public function userLoginCheck(string $pseudo, string $password)
    {
        $result = $this->userRepository->checkLogin($pseudo, $password);
        return $result;
    }

    /**
     * @param int $id
     * @param string $pseudo
     * @return bool
     */
    public function rememberUser(int $id, string $pseudo)
    {
        return $this->userRepository->rememberUser($id, $pseudo);
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        return $this->userRepository->isLogged();
    }

    /**
     * @param string $pseudo
     * @param string $password
     * @return User
     * @throws Exception
     */
    public function getUser(string $pseudo, string $password)
    {
        $result = $this->userRepository->getUser($pseudo, $password);
        if($result == null)
        {
            throw new Exception("User not found.");
        }
        return $result;
    }

    /**
     * @param string $userId
     * @return User
     * @throws Exception
     */
    public function getUserById(string $userId)
    {
        $result = $this->userRepository->findOneById($userId);
        if ($result == null)
        {
            throw new Exception("User not found.");
        }
        return $result;
    }

    public function updateUser(User $userToUpdate)
    {
        try
        {
            if ($this->getUserById($userToUpdate->getId()))
            {
                $this->userRepository->updateUser($userToUpdate);
            }
        } catch (Exception $e)
        {
            throw new Exception("User not found.");
        }
    }
}
