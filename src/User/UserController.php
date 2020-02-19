<?php
namespace User;
use PDO;

class UserController {
	private UserRepository $userRepository;

	public function __construct(PDO $connection) {
		$this->userRepository = new UserRepository($connection);
	}

	public function listUsers() {
		return $this->userRepository->fetchAll();
	}
}
?>
