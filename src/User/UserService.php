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

    private ?array $errors = [];

    public function getErrors() {
        return $this->errors;
    }

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
        $this->resetErrors();
        $result = false;
        if ($newUser != null)
        {
            $result = $this->userRepository->createUser($newUser);
            if ($result == false)
            {
                $this->errors['user_creation'] = 'User cannot be created.';
            }
        }
        else
        {
            $this->errors['user_null'] = 'Sent user is null.';
        }
        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllUser()
    {
        $this->resetErrors();
        return $this->userRepository->fetchAll();
    }

    /**
     * @param User $userToDelete
     * @return bool
     */
    public function deleteUser(User $userToDelete)
    {
        $this->resetErrors();
        $result = $this->userRepository->deleteUser($userToDelete);
        if ($result == false)
            $this->errors['user_delete'] = 'User cannot be deleted.';
        return $result;
    }

    /**
     * @param string $pseudo
     * @param string $password
     * @return bool
     */
    public function userLoginCheck(string $pseudo, string $password)
    {
        $this->resetErrors();
        $result = $this->userRepository->checkLogin($pseudo, $password);
        if ($result == false)
            $this->errors['user_login'] = 'Wrong login and password combination.';
        return $result;
    }

    /**
     * @param int $id
     * @param string $pseudo
     * @return bool
     */
    public function rememberUser(int $id, string $pseudo)
    {
        $this->resetErrors();
        $result = $this->userRepository->rememberUser($id, $pseudo);
        if ($result == false)
            $this->errors['user_login'] = 'A user is already connected.';
        return $result;
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        $this->resetErrors();
        return $this->userRepository->isLogged();
    }

    /**
     * @param string $pseudo
     * @param string $password
     * @return User
     */
    public function getUser(string $pseudo, string $password)
    {
        $this->resetErrors();
        $result = $this->userRepository->getUser($pseudo, $password);
        if($result == null)
        {
            $this->errors['user_fetch'] = 'User was not found.';
        }
        return $result;
    }

    /**
     * @param string $userId
     * @return User
     */
    public function getUserById(string $userId)
    {
        $this->resetErrors();
        $result = $this->userRepository->findOneById($userId);
        if ($result == null)
        {
            $this->errors['user_fetch'] = 'User was not found.';
        }
        return $result;
    }

    public function updateUser(User $userToUpdate)
    {
        $this->resetErrors();
        $result = false;
        if ($this->getUserById($userToUpdate->getId()) != null)
        {
            $result = $this->userRepository->updateUser($userToUpdate);
            if ($result == false)
            {
                $this->errors['user_update'] = 'User cannot be updated.';
            }
        }
        else
        {
            $this->errors['user_fetch'] = 'User was not found.';
        }
    }

    private function resetErrors()
    {
        $this->errors = [];
    }
}
