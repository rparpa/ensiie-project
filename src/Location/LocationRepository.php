<?php

namespace Location;

use Car\CarRepository;
use Exception;
use OutOfRangeException;
use PDO;
use RangeException;

class LocationRepository
{
    /**
     * @var \PDO
     */
    private PDO $connection;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     * @param CarRepository $carRepository
     */
    public function __construct(PDO $connection, CarRepository $carRepository)
    {
        $this->connection = $connection;
        $this->carRepository = $carRepository;
    }

    public function create($date_debut,$date_fin,$id_voiture,$km_max)
    {
        $date_diff = $date_debut->diff($date_fin)->format("%d");

        if ($date_diff < 0) {
            throw new RangeException("La date du debut est apres la date de fin");
        }
        if ($date_diff > 30) {
            throw new OutOfRangeException("La location dure plus de 30 jours");
        }

        if (!$this->isAvailable($id_voiture, $date_debut, $date_fin))
        {
            throw new Exception("La voiture n'est pas disponible");
        }

        $statement = $this->connection->prepare("INSERT INTO \"location\" (id_voiture,id_user,date_debut,date_fin,prix,km_max) values(:id_voiture,:id_user,:date_debut,:date_fin,:prix,:km_max)");

        $statement->bindParam(":id_voiture", $id_voiture);
        $statement->bindParam(":id_user", $_SESSION["id_user"]);
        @$statement->bindParam(":date_debut", $date_debut->format('Y-m-d H:i:s'));
        @$statement->bindParam(":date_fin", $date_fin->format('Y-m-d H:i:s'));
        $statement->bindParam(":km_max", $km_max);

        $car = $this->carRepository->fetch($id_voiture);

        $prix = $car->getPrix() * $date_diff;
        $statement->bindParam(":prix", $prix);

        $statement->execute();
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "location"
        inner join voiture USING(id_voiture)
        inner join "user" ON location.id_user="user".id')
            ->fetchAll(PDO::FETCH_OBJ);

        $locations = [];
        foreach ($rows as $row) {
            $location = new Location();
            $location
                ->setId($row->id_location)
                ->setVoitureImmat($row->immat)
                ->setUserEmail($row->email)
                ->setDateDebut(new \DateTimeImmutable($row->date_debut))
                ->setDateFin(new \DateTimeImmutable($row->date_fin))
                ->setPrix($row->prix)
                ->setKmMax($row->km_max);

            $locations[] = $location;
        }

        return $locations;
    }

    public function fetchVoiture($id_voiture)
    {
        $statement = $this->connection->prepare('SELECT * FROM "location"
        inner join voiture USING(id_voiture)
        inner join "user" ON location.id_user="user".id 
        WHERE id_voiture=:id_voiture');

        $statement->bindParam(":id_voiture", $id_voiture);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $locations = [];
        foreach ($rows as $row) {
            $location = new Location();
            $location
                ->setId($row->id_location)
                ->setVoitureImmat($row->immat)
                ->setUserEmail($row->email)
                ->setDateDebut(new \DateTimeImmutable($row->date_debut))
                ->setDateFin(new \DateTimeImmutable($row->date_fin))
                ->setPrix($row->prix)
                ->setKmMax($row->km_max);

            $locations[] = $location;
        }

        return $locations;
    }

    public function fetchUser($id_user)
    {
        $statement = $this->connection->prepare('SELECT * FROM "location"
        inner join voiture USING(id_voiture)
        inner join "user" ON location.id_user="user".id
        WHERE id_user=:id_user');

        $statement->bindParam(":id_user", $id_user);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        $locations = [];
        foreach ($rows as $row) {
            $location = new Location();
            $location
                ->setId($row->id_location)
                ->setVoitureImmat($row->immat)
                ->setUserEmail($row->email)
                ->setDateDebut(new \DateTimeImmutable($row->date_debut))
                ->setDateFin(new \DateTimeImmutable($row->date_fin))
                ->setPrix($row->prix)
                ->setKmMax($row->km_max);

            $locations[] = $location;
        }

        return $locations;
    }

    public function fetch($id_location)
    {
        $statement = $this->connection->prepare('SELECT * FROM "location"
        inner join voiture USING(id_voiture)
        inner join "user" ON location.id_user="user".id
        WHERE id_location=:id_location');

        $statement->bindParam(":id_location", $id_location);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        $location = new Location();
        $location
            ->setId($row->id_location)
            ->setVoitureImmat($row->immat)
            ->setUserEmail($row->email)
            ->setDateDebut(new \DateTimeImmutable($row->date_debut))
            ->setDateFin(new \DateTimeImmutable($row->date_fin))
            ->setPrix($row->prix)
            ->setKmMax($row->km_max);

        return $location;
    }

    public function delete($id_location)
    {
        $statement = $this->connection->prepare("DELETE FROM \"location\" WHERE id_location = :id_location");
        $statement->bindParam(":id_location", $id_location);
        $statement->execute();
    }

    public function update($id_location,$modifications) {
        foreach($modifications as $titre => $modif) {
            $modifsPrepared = $modifsPrepared . $titre . " = :" . $titre . " ";
        }
        $statement = $this->connection->prepare("UPDATE FROM \"location\" SET " . $modifsPrepared . "WHERE id_location = :id_location");
        foreach($modifications as $titre => $modif) {
            $statement->bindParam(":" . $titre, $modif);
        }
        
        $statement->execute();
    }

    public function isAvailable($id_voiture, $date_debut, $date_fin)
    {
        $statement = $this->connection->prepare("SELECT FROM \"location\" WHERE id_voiture = :id_voiture AND ((date_debut >= :date_debut AND date_debut <= :date_fin) OR (:date_debut >= date_debut AND :date_debut <= date_fin))");
        $statement->bindParam(":id_voiture", $id_voiture);
        @$statement->bindParam(":date_debut", $date_debut->format('Y-m-d H:i:s'));
        @$statement->bindParam(":date_fin", $date_fin->format('Y-m-d H:i:s'));
        $statement->execute();
        return $statement->rowCount() == 0;
    }
}
