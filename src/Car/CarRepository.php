<?php
namespace Car;
use PDO;

class CarRepository
{
    /**
     * @var \PDO
     */
    private PDO $connection;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "voiture" inner join marque USING(id_marque)
         inner join modele USING(id_modele) 
         inner join puissance USING(id_puissance) 
         inner join finition USING(id_finition)')->fetchAll(PDO::FETCH_OBJ);

        $voitures = [];
        foreach ($rows as $row) {
            $voiture = new Car();
            $voiture
                ->setId($row->id_voiture)
                ->setImmat($row->immat)
                ->setDateImmat(new \DateTimeImmutable($row->date_immat))
                ->setMarque($row->nom_marque)
                ->setModele($row->nom_modele)
                ->setPuissance($row->puissance_ch)
                ->setFinition($row->nom_finition)
                ->setImage($row->lien_img)
                ->setPrix($row->prix);

            $voitures[] = $voiture;
        }

        return $voitures;
    }

    public function fetchAvailable(\DateTimeInterface $dateDeb, $dateFin)
    {
        $statement = $this->connection->prepare('SELECT * FROM "voiture" inner join marque USING(id_marque)
         inner join modele USING(id_modele) 
         inner join puissance USING(id_puissance) 
         inner join finition USING(id_finition)
         WHERE id_voiture NOT IN (SELECT id_voiture, date_debut, date_fin FROM location WHERE date_debut > :date_deb AND date_fin < :date_fin)');

        $statement->bindParam(":date_deb",$dateDeb);
        $statement->bindParam(":date_fin",$dateFin);

        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_OBJ);

        $voitures = [];
        foreach ($rows as $row) {
            $voiture = new Car();
            $voiture
                ->setId($row->id_voiture)
                ->setImmat($row->immat)
                ->setDateImmat(new \DateTimeImmutable($row->date_immat))
                ->setMarque($row->nom_marque)
                ->setModele($row->nom_modele)
                ->setPuissance($row->puissance_ch)
                ->setFinition($row->nom_finition)
                ->setImage($row->lien_img)
                ->setPrix($row->prix);

            $voitures[] = $voiture;
        }

        return $voitures;
    }

	public function deconnexion() {
		session_destroy();
	}


}
