<?php

/**
 * Manager a pour role d'intéragir avec la base de données pour gérer les trocs.
 */

namespace Db;

use models\Troc;
use Db\Manager;
use models\User;
use PDO;

class TrocManager extends Manager {


    public function __construct(PDO $connection) {

        // TODO : Changer en Singleton
        // Initialisation de la connexion à la base de données
        $this->pdo=$connection;
    }

    /**
     * Ajoute un troc dans la base de données.
     * @param Troc $troc
     * @return Troc
     */

    public function create($troc) : ?Troc {
        $this->pdoStatement = $this->pdo->prepare("INSERT INTO tc_troc (tr_creation_date, tr_end_date, tr_is_done) VALUES (:creationdate, :enddate, :isdone)");

        $this->pdoStatement->bindValue(':creationdate', $troc->getCreationDate(), \PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':enddate', $troc->getEndDate(), \PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':isdone', $troc->getIsDone(), \PDO::PARAM_BOOL);

        $execute = $this->pdoStatement->execute();

        if ($execute) {
            $id = $this->pdo->lastInsertId();
            return $this->findById($id);
        } else {
            return null;
        }
    }


    /**
     * Récupère un troc
     * @param int $id
     * @return troc | bool
     */

    public function findById($id) {
        $this->pdoStatement = $this->pdo->prepare("SELECT * FROM tc_troc WHERE tr_id = :id LIMIT 1");
        $this->pdoStatement->bindValue(':idUser', $id, \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();


        if ($execute) {
            $dbarray = $this->pdoStatement->fetchAll()[0];

            if ($dbarray === false) {
                return null;
            } else {
                #print_r($dbarray);
                return new Troc($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3]);
            }
            //return $this->pdoStatement->fetchObject('..\models\Troc');
        }
        else return false;
    }


    /**
     * DEPRECIE
     * Refuser un troc
     * @param Troc $troc
     * @return bool
     */
    /*
        public function refuseTroc(Troc $troc) {

            $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_is_done = TRUE, tr_is_accepted = FALSE WHERE tr_id = :id");
            $this->pdoStatement->bindValue(':id', $troc->getId(), \PDO::PARAM_INT);
            $execute = $this->pdoStatement->execute();

            if ($execute) {
                return true;
            }

            return false;
        }

     */
        /**
         *  DEPRECIE
         *  Accepter un troc
         *  @param Troc $troc
         *  @return bool
         */
    /*
    public function acceptTroc(Troc $troc) {

        $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_is_done = TRUE, tr_is_accepted = TRUE WHERE tr_id = :id");
        $this->pdoStatement->bindValue(':id', $troc->getId(), \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        if ($execute) {
            return true;
        }

        return false;
    }
    */

    public function update($object) {
        if ($object instanceof Troc) {
            $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_creation_date = :creationdate, tr_end_date = :enddate, tr_is_done = :isdone, tr_is_accepted = :isaccepted WHERE tr_id = :id");

            $this->pdoStatement->bindValue(':creationdate', $object->getCreationDate(), \PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':enddate', $object->getEndDate(), \PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':isdone', $object->getIsDone(), \PDO::PARAM_BOOL);
            $this->pdoStatement->bindValue(':isaccepted', $object->getIsAccepted(), \PDO::PARAM_BOOL);
            $this->pdoStatement->bindValue(':id', $object->getId(), \PDO::PARAM_INT);

            $execute = $this->pdoStatement->execute();

            if ($execute) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function findAll() : array{
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_troc');
        $trocs = [];

        $dbarray = $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dbarray as $db_row) {
            $trocs[] = new Troc($db_row[0], $db_row[1], $db_row[2], $db_row[3]);
        }

        return $trocs;
    }

    public function delete($troc) {
        if ($troc instanceof Troc) {
            $this->pdoStatement = $this->pdo->prepare('DELETE FROM tc_troc WHERE tr_id =:id');
            $this->pdoStatement->bindValue(':id', $troc->getId(), PDO::PARAM_INT);

            return $this->pdoStatement->execute();
        }
    }


}