<?php
namespace Register;
use PDO;

class RegisterController {
	private Register $register;
	private RegisterView $registerView;

	public function __construct(PDO $connection) {
		$this->register = new Register($connection);
		$this->registerView = new RegisterView();
	}

	public function afficheFormulaire() {
		try {
			$this->registerView->afficheFormulaire();
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function enregistrement($post) {
		try {
			if(($rep=$this->register->enregistrement($post))!==false) {
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

}
