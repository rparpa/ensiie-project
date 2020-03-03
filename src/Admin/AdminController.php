<?php
namespace Admin;

use PDO;
use Exception;

require_once '../src/Bootstrap.php';

class AdminController {
	private \Car\CarRepository $carRepository;
	private \Car\CarView $carView;
	private \Location\LocationRepository $locationRepository;
	private AdminView $adminView;
	private AdminModel $adminModel;

	public function __construct(PDO $connection) {
		$this->accessControl();
		$this->carRepository = new \Car\CarRepository($connection);
		$this->locationRepository = new \Location\LocationRepository($connection, $this->carRepository);
		$this->carView = new \Car\CarView();
		$this->adminView = new AdminView();
	}

	public function accessControl() {
		if (!$_SESSION["role"] == 1) {
			echo "Vous n'êtes pas autorisé à accéder à cette page.";
			exit();
		}
	}

	public function afficheAjoutVoiture() {
		try {
			$this->adminView->afficheAjoutVoiture();
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoitures() {
		try {
			$this->adminView->afficheVoitures($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function ajoutVoiture($post) {
		if($this->carRepository->ajoutVoiture($post)!==false) {
			echo "ok";
		} else {
			echo "pasok";
		}
	}

	public function modifVoiture($post) {
		if($this->carRepository->modifVoiture($post)!==false) {
			echo "ok";
		} else {
			echo "pasok";
		}
	}

	public function deleteVoiture($post) {
		if($this->carRepository->deleteVoiture($post)!==false) {
			echo "ok";
		} else {
			echo "pasok";
		}
	}
	
	public function afficheLocations(){
		try {
			$this->adminView->afficheLocations($this->locationRepository->fetchAll());
		} catch (Exception $e) {
			//$this->userView->vueErreur($e->getMessage());
		}
	}
	public function deleteLocation($post)
    {
        try {
            $this->locationRepository->delete($post);
        } catch (Exception $e) {
            //$this->userView->vueErreur($e->getMessage());
        }
    }
}
?>
