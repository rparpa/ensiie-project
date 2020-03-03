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

	public function searchCars($string) {
        header("Content-Type: application/json");
        $recherche = explode(" ", $string);
        $marque = $recherche[0];
        if(sizeof($recherche) >= 2)
            $modele = $recherche[1];
        if(sizeof($recherche) >= 3)
            $finition = $recherche[2];
        if(sizeof($recherche) >= 4)
            $puissance = $recherche[3];

        // TODO link brands and models so that we don't get BMW S60 for instance
        // TODO refactor, ugly

        $return = "{}";

        if(isset($marque)) {
            $marques = $this->carRepository->searchBrand($marque);
            $return = json_encode(array("status"=>1,"marque"=>$marques));
        }

        if(isset($modele) && sizeof($marques)==1) {
            $modeles = $this->carRepository->searchModel($modele);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles));
        }

        if(isset($finition) && sizeof($modeles)==1) {
            $finitions = $this->carRepository->searchFinition($finition);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles,"finition"=>$finitions));
        }

        if(isset($puissance) && sizeof($puissances)==1) {
            $puissances = $this->carRepository->searchPuissance($puissance);
            $return = json_encode(array("status"=>1,"marque"=>$marques,"modele"=>$modeles,"finition"=>$finitions,"puissance"=>$puissances));
        }

        echo $return;
        die();
    }
}
?>
