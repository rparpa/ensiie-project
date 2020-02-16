<?php

namespace Rediite\Model\Service;

use Rediite\Model\Repository\UserRepository;
use Rediite\Model\Entity\User as UserEntity;

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

  function getCurrentUser(): ?UserEntity
   {
    $userId = $this->getCurrentUserId();
    if ($userId) {
      return $this->userRepository->findOneById($userId);
    }
    return null;
  }
}