<?php

/**
 * Manager a pour role d'intéragir avec la base de données pour gérer les trocs.
 */

namespace Db;
use PDO;
use models\Troc;

class TrocManager {

    private PDO $pdo;
    private $pdoStatement;

    public function __construct(PDO $connection) {

        // TODO : Changer en Singleton
        // Initialisation de la connexion à la base de données
        $this->pdo=$connection;
    }

    /**
     * Ajoute un troc dans la base de données.
     * @param Troc $troc
     * @return bool
     */

    public function insertTroc(Troc &$troc) {
        $this->pdoStatement = $this->pdo->prepare("INSERT INTO tc_troc (tr_creation_date, tr_end_date, tr_is_done) VALUES (:creationdate, :enddate, :isdone)");

        $this->pdoStatement->bindValue(':creationdate', $troc->getCreationDate(), \PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':enddate', $troc->getEndDate(), \PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':isdone', $troc->getIsDone(), \PDO::PARAM_BOOL);

        $execute = $this->pdoStatement->execute();

        if ($execute) {
            // TODO : Récupérer l'objet inséré et l'affecter à item
            // Pour ça il faut récupérer l'identifiant créé par la base de données
            return true;
        } else {
            return false;
        }
    }


    /**
     * Récupère un troc
     * @param int $id
     * @return troc | bool
     */

    public function getTroc(int $id) {
        $this->pdoStatement = $this->pdo->prepare("SELECT * FROM tc_troc WHERE tr_id = :id LIMIT 1");
        $this->pdoStatement->bindValue(':idUser', $id, \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        // TODO : Affecter l'id du troc en BDD à l'objet troc
        if ($execute) return $this->pdoStatement->fetchObject('..\models\Troc');
        else return false;
    }


    /**
     * Refuser un troc
     * @param Troc $troc
     * @return bool
     */

    public function refuseTroc(Troc $troc) {

        $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_is_done = TRUE, tr_is_accepted = FALSE WHERE tr_id = :id");
        $this->pdoStatement->bindValue(':id', $troc->getId(), \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        if ($execute) {
            return true;
        }

        return false;
    }


    /**
     *  Accepter un troc
     *  @param Troc $troc
     *  @return bool
     */
    public function acceptTroc(Troc $troc) {

        $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_is_done = TRUE, tr_is_accepted = TRUE WHERE tr_id = :id");
        $this->pdoStatement->bindValue(':id', $troc->getId(), \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        if ($execute) {
            return true;
        }

        return false;
    }









}