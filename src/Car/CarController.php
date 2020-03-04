<?php
namespace Car;
use PDO;
use Exception;

class CarController {
	private CarRepository $carRepository;
	private CarView $carView;
	private \Location\LocationRepository $locationRepository;

	public function __construct(PDO $connection) {
		$this->carRepository = new CarRepository($connection);
		$this->carView = new CarView();
		$this->locationRepository = new \Location\LocationRepository($connection, $this->carRepository);
	}

	public function afficheVoitures() {
		try {
			$this->carView->afficheVoitures($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoiture($post) {
		try {
			$voitures[] = $this->carRepository->fetch($post);
			$this->carView->afficheVoitures($voitures);
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function createVoiture($post) {
		try {
			$this->carRepository->create($post['immat'],new \DateTimeImmutable($post['date_immat']),$post['id_marque'],$post['id_puissance'],$post['id_finition'],$post['lien_img'],$post['prix']);
		} catch(Exception $e) {

		}
	}

	public function supprimeVoiture($id) {
		try {
			$this->carRepository->delete($id);
		} catch(Exception $e) {

		}
	}

	public function updateVoiture($id, $post) {
		$modifications;
		if($post['immat'])
			$modifications['immat'] = $post['immat'];
		if($post['date_immat'])
			$modifications['date_immat'] = $post['date_immat'];
		/*if($post['id_marque'])
		if($post['id_puissance'])
		if($post['id_finition'])*/
		if($post['lien_img'])
			$modifications['lien_img'] = $post['lien_img'];
		if($post['prix'])
			$modifications['prix'] = $post['prix'];

		try {
			$voitures[] = $this->carRepository->update($id,$modifications);
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoituresIndex() {
		try {
			$this->carView->afficheVoituresIndex($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function createLocation($post)
    {
        try {
			$date_debut = new \DateTimeImmutable($post['date_debut']);
			$date_fin = new \DateTimeImmutable($post['date_fin']);

            $this->locationRepository->create($date_debut,$date_fin,$post['id_voiture'],$post['km_max']);
            $this->carView->afficheLocation($post);
        } catch (Exception $e) {
            //$this->userView->vueErreur($e->getMessage());
        }
    }
}
?>
