<?php

namespace Location;

use Car\CarRepository;
use OutOfRangeException;
use PDO;

class LocationRepository
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

    public function create($post)
    {
        $date_debut = new \DateTimeImmutable($post["date_debut"]);
        $date_fin = new \DateTimeImmutable($post["date_fin"]);
        $date_diff = $date_debut->diff($date_fin)->format("%d");

        if ($date_diff < 0) {
            throw new OutOfRangeException("La date du debut est apres la date de fin");
        }
        if ($date_diff > 30) {
            throw new OutOfRangeException("La location dure plus de 30 jours");
        }

        $statement = $this->connection->prepare("INSERT INTO \"location\" (id_voiture,id_user,date_debut,date_fin,prix,km_max) values(:id_voiture,:id_user,:date_debut,:date_fin,:prix,:km_max)");

        $statement->bindParam(":id_voiture", $post["id_voiture"]);
        $statement->bindParam(":id_user", $_SESSION["id_user"]);
        $statement->bindParam(":date_debut", $post["date_debut"]);
        $statement->bindParam(":date_fin", $post["date_fin"]);
        $statement->bindParam(":km_max", $post["km_max"]);

        $voiture = CarRepository->fetch($post["id_voiture"]);
        $prix = $voiture->getPrix() * $date_diff;
        $statement->bindParam(":prix", $prix);

        $statement->execute();
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "location"
        inner join voiture USING(id_voiture)
        inner join user USING(id_user)')
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
        inner join user USING(id_user) 
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
        inner join user USING(id_user) 
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
        inner join user USING(id_user) 
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

    public function delete($post)
    {
        $statement = $this->connection->prepare("DELETE FROM \"location\" WHERE id_location = :id_location");
        $statement->bindParam(":id_location", $post["id_location"]);
        $statement->execute();
    }
}
