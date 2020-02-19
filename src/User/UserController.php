<?php
namespace User;
use PDO;

class UserController {
	private UserRepository $userRepository;
	private UserView $userView;

	public function __construct(PDO $connection) {
		$this->userRepository = new UserRepository($connection);
		$this->userView = new UserView();
	}

	public function listUsers() {
		return $this->userView->showUsers($this->userRepository->fetchAll());
	}
}
?>
