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
		try {
			$this->carRepository->create($post['immat'],$post['date_immat'],$post['id_marque'],$post['id_modele'],$post['id_puissance'],$post['id_finition'],$post['prix']);
			$this->adminView->afficheAjout($post);
		} catch(Exception $e) {
			echo $e;
		}
	}

	public function afficheModifVoiture($car_id) {
		try {
			$this->adminView->afficheModifVoiture($this->carRepository->fetch($car_id));
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function modifVoiture($id, $post) {
		$modifications;
		if(isset($post['immat']))
			$modifications['immat'] = $post['immat'];
		if(isset($post['date_immat']))
			$modifications['date_immat'] = $post['date_immat'];
		/*if($post['id_marque'])
		if($post['id_puissance'])
		if($post['id_finition'])*/
		if(isset($post['lien_img']))
			$modifications['lien_img'] = $post['lien_img'];
		if(isset($post['prix']))
			$modifications['prix'] = $post['prix'];

		try {
			$voitures[] = $this->carRepository->update($id,$modifications);
			$this->adminView->afficheModif($post);
		} catch(Exception $e) {
			echo $e;
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function deleteVoiture($post) {
		try {
			$this->carRepository->delete($post['car_id']);
			$this->adminView->afficheDelete($post);
		} catch(Exception $e) {
			//echo $e;
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
            $this->locationRepository->delete($post['location_id']);
            $this->adminView->afficheDeleteLocation($post);
        } catch (Exception $e) {
            //$this->userView->vueErreur($e->getMessage());
        }
    }
}
?>
