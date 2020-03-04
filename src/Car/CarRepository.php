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


    public function create($immat, $date_immat, $id_marque, $id_modele, $id_puissance, $id_finition, $lien_img, $prix)
    {
        $date_immat = new \DateTimeImmutable($date_immat);

        $statement = $this->connection->prepare("INSERT INTO \"voiture\" (immat,date_immat,id_marque,id_modele,id_puissance,id_finition,lien_img,prix)\
                                                values(:immat,:date_immat,:id_marque,:id_modele,:id_puissance,:id_finition,:lien_img,:prix)");

        $statement->bindParam(":immat", $immat);
        $statement->bindParam(":date_immat", $date_immat);
        $statement->bindParam(":id_marque", $id_marque);
        $statement->bindParam(":id_puissance", $id_puissance);
        $statement->bindParam(":id_finition", $id_finition);
        $statement->bindParam(":lien_img", $lien_img);
        $statement->bindParam(":prix", $prix);

        $statement->execute();
    }

    public function delete($id_voiture) {
        $statement = $this->connection->prepare("DELETE FROM \"location\" WHERE id_voiture = :id_voiture");
        $statement->bindParam(":id_voiture", $id_voiture);
        $statement->execute();
    }

    public function update($id_voiture,$modifications) {
        foreach($modifications as $titre => $modif) {
            $modifsPrepared = $modifsPrepared . $titre . " = :" . $titre . " ";
        }
        $statement = $this->connection->prepare("UPDATE FROM \"voiture\" SET " . $modifsPrepared . "WHERE id_voiture = :id_voiture");
        foreach($modifications as $titre => $modif) {
            $statement->bindParam(":" . $titre, $modif);
        }
        
        $statement->execute();
    }

    public function searchBrand($brand) {
        $statement = $this->connection->prepare("SELECT * FROM marque WHERE nom_marque LIKE ?");

        $statement->execute(array("%".$brand."%"));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $marques = [];
        
        foreach ($rows as $row) {
            $marques[] = array($row->id_marque=>$row->nom_marque);
        }

        return $marques;
    } 

    public function searchModel($model) {
        $statement = $this->connection->prepare("SELECT * FROM modele WHERE nom_modele LIKE ?");

        $statement->execute(array("%".$model."%"));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $modeles = [];
        
        foreach ($rows as $row) {
            $modeles[] = array($row->id_modele=>$row->nom_modele);
        }

        return $modeles;
    }

    public function searchPuissance($puissance) {
        $statement = $this->connection->prepare("SELECT * FROM puissance WHERE puissance_ch LIKE ?");

        $statement->execute(array("%".$puissance."%"));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $puissances = [];
        
        foreach ($rows as $row) {
            $puissances[] = array($row->id_puissance=>$row->puissance_ch);
        }

        return $puissances;
    }

    public function searchFinition($finition) {
        $statement = $this->connection->prepare("SELECT * FROM finition WHERE nom_finition LIKE ?");

        $statement->execute(array("%".$finition."%"));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finitions = [];
        
        foreach ($rows as $row) {
            $finitions[] = array($row->id_finition=>$row->nom_finition);
        }

        return $finitions;
    }

    public function fetch($id)
    {
        $statement = $this->connection->prepare('SELECT * FROM "voiture" inner join marque USING(id_marque)
         inner join modele USING(id_modele) 
         inner join puissance USING(id_puissance) 
         inner join finition USING(id_finition)
         WHERE id_voiture=:id_voiture');

        $statement->bindParam(":id_voiture",$id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_OBJ);

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

        return $voiture;
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
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

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

    public function ajoutVoiture($post) {
        // TODO
    }

    public function modifVoiture($post) {
        // TODO
    }

    public function deleteVoiture($post) {
        // TODO
    }

}
