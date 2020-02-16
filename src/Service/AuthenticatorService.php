<?php

namespace Service;


use User\User;
use User\UserRepository;

class AuthenticatorService
{

  /**
  * @var UserRepository
  */
  private $userRepository;

  /**
   * AuthenticatorService constructor.
   * @param UserRepository $userRepository
   */
  public function __construct (UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  function isAuthenticated(): bool
  {
    return isset($_SESSION['user_id']);
  }

  function getCurrentUserId(): ?int
  {
    return $this->isAuthenticated() ? $_SESSION['user_id'] : null;
  }

  function getCurrentUser(): ?User
   {
    $userId = $this->getCurrentUserId();
    //var_dump($userId);
    if ($userId) {
      return $this->userRepository->findOneById($userId);
    }
    return null;
  }
}