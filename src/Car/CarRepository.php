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
        $statement = $this->connection->prepare("DELETE FROM \"voiture\" WHERE id_voiture = :id_voiture");
        $statement->bindParam(":id_voiture", $id_voiture);
        $statement->execute();
    }

    public function update($id_voiture,$modifications) {
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $modifsPrepared = "";
        $i = 0;
        $len = count($modifications);
        foreach($modifications as $titre => $modif) {
            if($i < $len-1) {
                $modifsPrepared = $modifsPrepared . $titre . " = :" . $titre . ",";
            } else {
                $modifsPrepared = $modifsPrepared . $titre . " = :" . $titre;
            }
            $i++;
        }
        $statement = $this->connection->prepare("UPDATE \"voiture\" SET " . $modifsPrepared . " WHERE id_voiture = :id_voiture");

        //echo "UPDATE \"voiture\" SET " . $modifsPrepared . " WHERE id_voiture = :id_voiture";
        //die();

        $statement->bindParam(":id_voiture",$id_voiture);
        foreach($modifications as $titre => $modif) {
            $statement->bindParam(":" . $titre, $modif);
        }
        
        $statement->execute();
    }

    public function searchBrand($brand) {
        //$brand = strtolower($brand);
        $statement = $this->connection->prepare("SELECT * FROM marque WHERE nom_marque ILIKE ?");

        $statement->execute(array("%".$brand."%"));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $marques = [];
        
        foreach ($rows as $row) {
            $marques[] = array("id_marque"=>$row->id_marque,"nom_marque"=>$row->nom_marque);
        }

        return $marques;
    } 

    public function searchModel($model,$brand) {
        $statement = $this->connection->prepare("SELECT * FROM modele WHERE nom_modele ILIKE ? AND id_marque = ?");

        $statement->execute(array("%".$model."%",$brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $modeles = [];
        
        foreach ($rows as $row) {
            $modeles[] = array("id_modele"=>$row->id_modele,"nom_modele"=>$row->nom_modele);
        }

        return $modeles;
    }

    public function searchPuissance($puissance,$brand) {
        $statement = $this->connection->prepare("SELECT * FROM puissance WHERE puissance_ch ILIKE ? AND id_marque = ?");

        $statement->execute(array("%".$puissance."%",$brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $puissances = [];
        
        foreach ($rows as $row) {
            $puissances[] = array("id_puissance"=>$row->id_puissance,"puissance_ch"=>$row->puissance_ch);
        }

        return $puissances;
    }

    public function searchFinition($finition,$brand) {
        $statement = $this->connection->prepare("SELECT * FROM finition WHERE nom_finition ILIKE ? AND id_marque = ?");

        $statement->execute(array("%".$finition."%",$brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finitions = [];
        
        foreach ($rows as $row) {
            $finitions[] = array("id_finition"=>$row->id_finition,"nom_finition"=>$row->nom_finition);
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

    public function fetchAvailable($date_debut, $date_fin, $prix=false, $id_marque=false,$id_modele=false,$id_finition=false,$id_puissance=false)
    {
        $additions = "";
        if($id_marque !== false)
            $additions .= " AND id_marque=:id_marque";
        if($id_modele !== false)
            $additions .= " AND id_modele=:id_modele";
        if($id_finition !== false)
            $additions .= " AND id_finition=:id_finition";
        if($id_puissance !== false)
            $additions .= " AND id_puissance=:id_puissance";
        if($prix !== false)
            $additions .= " AND prix=:prix";

        $statement = $this->connection->prepare('SELECT * FROM "voiture" inner join marque USING(id_marque)
         inner join modele USING(id_modele) 
         inner join puissance USING(id_puissance) 
         inner join finition USING(id_finition)
         WHERE id_voiture NOT IN (SELECT id_voiture FROM location WHERE date_debut > :date_debut AND date_fin < :date_fin)' . $additions);
         //         WHERE id_voiture NOT IN (SELECT id_voiture, date_debut, date_fin FROM location WHERE date_debut > :date_debut AND date_fin < :date_fin)' . $additions);

        $statement->bindParam(":date_debut", $date_debut);
        $statement->bindParam(":date_fin", $date_fin);
        if($id_marque !== false) { $statement->bindParam(":id_marque",$id_marque); }
        if($id_modele !== false) { $statement->bindParam(":id_modele",$id_modele); }
        if($id_finition !== false) { $statement->bindParam(":id_finition",$id_finition); }
        if($id_puissance !== false) { $statement->bindParam(":id_puissance",$id_puissance); }
        if($prix !== false) { $statement->bindParam(":prix",$prix); }

        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $voitures = [];
        foreach ($rows as $row) {
            $voitures[] = $row;
        }

        return $voitures;
    }

    public function fetchBrands() {
        $statement = $this->connection->prepare("SELECT * FROM marque");
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finalprod = [];
        
        foreach ($rows as $row) {
            $finalprod[] = array("id"=>$row->id_marque,"nom"=>$row->nom_marque);
        }

        return $finalprod;
    }

    public function fetchModels($brand) {
        $statement = $this->connection->prepare("SELECT * FROM modele WHERE id_marque = ?");

        $statement->execute(array($brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finalprod = [];
        
        foreach ($rows as $row) {
            $finalprod[] = array("id"=>$row->id_modele,"nom"=>$row->nom_modele);
        }

        return $finalprod;
    }

    public function fetchPuissances($brand) {
        $statement = $this->connection->prepare("SELECT * FROM puissance WHERE id_marque = ?");

        $statement->execute(array($brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finalprod = [];
        
        foreach ($rows as $row) {
            $finalprod[] = array("id"=>$row->id_puissance,"nom"=>$row->puissance_ch);
        }

        return $finalprod;
    }

    public function fetchFinition($brand) {
        $statement = $this->connection->prepare("SELECT * FROM finition WHERE id_marque = ?");

        $statement->execute(array($brand));
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $finalprod = [];
        
        foreach ($rows as $row) {
            $finalprod[] = array("id"=>$row->id_finition,"nom"=>$row->nom_finition);
        }

        return $finalprod;
    }

    public function fetchEveryPossibleCar() {
        $statement = $this->connection->prepare('SELECT id_marque, nom_marque FROM "marque"');
        $statement->execute();
        $marques = $statement->fetchAll(PDO::FETCH_OBJ);

        $statement = $this->connection->prepare('SELECT id_marque, nom_marque, id_modele, nom_modele FROM "marque"
         inner join modele USING(id_marque)');
        $statement->execute();
        $marquesModeles = $statement->fetchAll(PDO::FETCH_OBJ);

        $statement = $this->connection->prepare('SELECT id_marque, nom_marque, id_modele, nom_modele, id_finition, nom_finition FROM "marque"
        inner join modele USING(id_marque) 
        inner join finition USING(id_marque)');
        $statement->execute();
        $marquesModelesFinitions = $statement->fetchAll(PDO::FETCH_OBJ);

        $statement = $this->connection->prepare('SELECT id_marque, nom_marque, id_modele, nom_modele, id_puissance, puissance_ch, id_finition, nom_finition FROM "marque"
        inner join modele USING(id_marque) 
        inner join puissance USING(id_marque) 
        inner join finition USING(id_marque)');
        $statement->execute();
        $marquesModelesFinitionsPuissances = $statement->fetchAll(PDO::FETCH_OBJ);

        $voitures = [];
        foreach ($marques as $row) {
            $voitures[] = array("id_marque"=>$row->id_marque,"nom_marque"=>$row->nom_marque);
        }
        foreach ($marquesModeles as $row) {
            $voitures[] = array("id_marque"=>$row->id_marque,"nom_marque"=>$row->nom_marque,"id_modele"=>$row->id_modele,"nom_modele"=>$row->nom_modele);
        }
        foreach ($marquesModelesFinitions as $row) {
            $voitures[] = array("id_marque"=>$row->id_marque,"nom_marque"=>$row->nom_marque,"id_modele"=>$row->id_modele,"nom_modele"=>$row->nom_modele,"id_finition"=>$row->id_finition,"nom_finition"=>$row->nom_finition);
        }
        foreach ($marquesModelesFinitionsPuissances as $row) {
            $voitures[] = array("id_marque"=>$row->id_marque,"nom_marque"=>$row->nom_marque,"id_modele"=>$row->id_modele,"nom_modele"=>$row->nom_modele,"id_finition"=>$row->id_finition,"nom_finition"=>$row->nom_finition,"id_puissance"=>$row->id_puissance,"puissance_ch"=>$row->puissance_ch);
        }
        
        return $voitures;
    }

	public function deconnexion() {
		session_destroy();
	}
}
