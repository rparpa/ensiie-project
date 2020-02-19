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
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheFormulaireConnexion() {
		try {
			$this->userView->afficheFormulaireConnexion();
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function listUsers() {
		return $this->userView->showUsers($this->userRepository->fetchAll());
	}

	public function identification($post) {
		try {
			if(($rep=$this->userRepository->identification($post))!=false) {
				?>Bien connecté !<?php
				//$this->connexionView->vue_confirm("Vous vous êtes connecté!");
				//header("Refresh:2; url=index.php");
			} else {
				?>Vérifiez vos credentials ...<?php
				//$this->connexionView->vue_erreur("Mauvais mail ou mot de passe!");
				//header("Refresh:2; url=index.php?module=connexion");
			}
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function enregistrement($post) {
		try {
			if(($rep=$this->userRepository->enregistrement($post))!==false) {
				?>INSCRIT !<?php
				//$this->connexionView->vue_confirm("Vous vous êtes connecté!");
				//header("Refresh:2; url=index.php");
			} else {
				?>Problème inscription<?php
				//$this->connexionView->vue_erreur("Mauvais mail ou mot de passe!");
				//header("Refresh:2; url=index.php?module=connexion");
			}
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function deconnexion() {
		if(isset($_SESSION["id_user"])) {
			try {
				$this->userRepository->deconnexion();
				//$this->connexionView->vue_confirm("Vous vous êtes correctement déconnecté");
				header("Refresh:2; url=index.php");

			} catch(Exception $e) {
				//$this->connexionView->vue_erreur("La déconnexion a échoué");
			}
		}
	}
}
?>
