<?php
namespace Connexion;
use PDO;

class ConnexionController {
	private Connexion $connexion;
	private ConnexionView $connexionView;

	public function __construct(PDO $connection) {
		$this->connexion = new Connexion($connection);
		$this->connexionView = new ConnexionView();
	}

	public function afficheFormulaire() {
		try {
			$this->connexionView->afficheFormulaire();
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function identification($post) {
		try {
			if(($rep=$this->connexion->identification($post))!=false) {
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

	public function deconnexion() {
		if(isset($_SESSION["id_user"])) {
			try {
				$this->connexion->deconnexion();
				//$this->connexionView->vue_confirm("Vous vous êtes correctement déconnecté");
				header("Refresh:2; url=index.php");

			} catch(Exception $e) {
				//$this->connexionView->vue_erreur("La déconnexion a échoué");
			}
		}
	}

}
