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

	public function afficheFormulaireInscription() {
		try {
			$this->userView->afficheFormulaireInscription();
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}

	public function afficheFormulaireConnexion() {
		try {
			$this->userView->afficheFormulaireConnexion();
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}

	public function listUsers() {
		return $this->userView->showUsers($this->userRepository->fetchAll());
	}

	public function identification($post) {
		try {
			if(($rep=$this->userRepository->identification($post['email'],$post['password']))!=false) {
				$this->userView->vueConfirm("Vous êtes désormais connecté.");
				header("Refresh:0; url=index.php");
			} else {
				?>Vérifiez vos credentials ...<?php
				$this->userView->vueErreur("Erreur dans le formulaire.");
				header("Refresh:0; url=index.php?action=connect");
			}
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}

	public function enregistrement($post) {
		try {
			if(($rep=$this->userRepository->enregistrement($post['name'],$post['firstname'],$post['email'],$post['birthday'],$post['password']))!==false) {
				$this->userView->vueConfirm("Vous êtes désormais inscrit.");
				header("Refresh:0; url=index.php");
			} else {
				$this->userView->vueErreur("Erreur dans le formulaire.");
				header("Refresh:0; url=index.php?action=register");
			}
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}

	public function deconnexion() {
		if(isset($_SESSION["id_user"])) {
			try {
				$this->userRepository->deconnexion();
				$this->userView->vueConfirm("Vous êtes désormais déconnecté.");
				header("Refresh:0; url=index.php");

			} catch(Exception $e) {
				$this->userView->vueErreur("La déconnexion a échoué");
			}
		}
	}

	public function afficheFormulaireReset() {
		try {
			$this->userView->afficheFormulaireReset();
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}

	public function reset($email) {
		try {
			$this->userView->vueConfirm("Un email de réinitialisation a été envoyé.");
			header("Refresh:0; url=index.php");
		} catch(Exception $e) {
			$this->userView->vueErreur($e->getMessage());
		}
	}
}
?>