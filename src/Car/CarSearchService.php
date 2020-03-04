<?php
namespace Car;
use PDO;
use Exception;

class CarSearchService {
	private CarRepository $carRepository;
	private CarView $carView;
	private \Location\LocationRepository $locationRepository;

	public function __construct(PDO $connection) {
		$this->carRepository = new CarRepository($connection);
		$this->carView = new CarView();
		$this->locationRepository = new \Location\LocationRepository($connection, $this->carRepository);
	}

	/*public function searchCars($string) {
        header("Content-Type: application/json");
        $recherche = explode(" ", $string);
        $marque = $recherche[0];
        if(sizeof($recherche) >= 2)
            $modele = $recherche[1];
        if(sizeof($recherche) >= 3)
            $finition = $recherche[2];
        if(sizeof($recherche) >= 4)
            $puissance = $recherche[3];

        $return = "{}";

        if(isset($marque)) {
            $marques = $this->carRepository->searchBrand($marque);
            $return = json_encode(array("status"=>1,"marque"=>$marques));
        }

        if(isset($modele) && sizeof($marques)==1) {
            $modeles = $this->carRepository->searchModel($modele,$marques[0]['id_marque']);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles));
        }

        if(isset($finition) && sizeof($modeles)==1) {
            $finitions = $this->carRepository->searchFinition($finition,$marques[0]['id_marque']);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles,"finition"=>$finitions));
        }

        if(isset($puissance) && sizeof($puissances)==1) {
            $puissances = $this->carRepository->searchPuissance($puissance,$marques[0]['id_marque']);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles,"finition"=>$finitions,"puissance"=>$puissances));
        }

        echo $return;
        die();
    }*/

    public function fetchEveryPossibleCar($string) {
        header("Content-Type: application/json");
        $cars = $this->carRepository->fetchEveryPossibleCar();
        echo json_encode(array("status"=>1,"content"=>$cars));
        die();
    }

    public function searchCar($POST) {
        header("Content-Type: application/json");
        if($POST["budget"] == "" || $POST["budget"] == 0)
            $budget = false;
        else
            $budget = $POST["budget"];

        $date_debut = $POST["date_debut"];
        $date_fin = $POST["date_fin"];
        
        if($POST["id_marque"] != "" && $POST["id_modele"] != "" && $POST["id_finition"] != "" && $POST["id_puissance"] != "")
            $cars = $this->carRepository->fetchAvailable($date_debut,$date_fin,$budget,$POST["id_marque"],$POST["id_modele"],$POST["id_finition"],$POST["id_puissance"]);
        else if($POST["id_marque"] != "" && $POST["id_modele"] != "" && $POST["id_finition"] != "")
            $cars = $this->carRepository->fetchAvailable($date_debut,$date_fin,$budget,$POST["id_marque"],$POST["id_modele"],$POST["id_finition"]);
        else if($POST["id_marque"] != "" && $POST["id_modele"] != "")
            $cars = $this->carRepository->fetchAvailable($date_debut,$date_fin,$budget,$POST["id_marque"],$POST["id_modele"]);
        else if($POST["id_marque"] != "")
            $cars = $this->carRepository->fetchAvailable($date_debut,$date_fin,$budget,$POST["id_marque"]);
        else
            $cars = $this->carRepository->fetchAvailable($date_debut,$date_fin);
        echo json_encode(array("status"=>1,"content"=>$cars));
        die();
    }
}
?>
