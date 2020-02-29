<?php

namespace Service;


use User\User;
use User\UserRepository;

class AuthenticatorService
{

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     *
     * AuthenticatorService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct (UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return bool
     */
    function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * @return int|null
     */
    function getCurrentUserId(): ?int
    {
        return $this->isAuthenticated() ? $_SESSION['user_id'] : null;
    }

    /**
     * @return bool
     */
    function isAdministrateur():bool {
        if($this->isAuthenticated())
        {
            return $this->getCurrentUser()->getIsadmin();
        }
        return false;
    }

    function getCurrentUser(): ?User
    {
        $userId = $this->getCurrentUserId();
        if ($userId) {
            return $this->userRepository->findOneById($userId);
        }
        return null;
    }
}