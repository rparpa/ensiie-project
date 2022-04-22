<?php

/**
 * Manager a pour role d'intéragir avec la base de données pour gérer les trocs.
 */

namespace Db;

use models\Item;
use models\Swap;
use Db\Manager;
use models\User;
use PDO;

class SwapManager extends Manager
{


    private ItemManager $itemManager;

    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
        $this->itemManager = new ItemManager($connection);
    }

    public function findAll(): array
    {
        $swaps = [];
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_swap');
        return $this->executeQueryAndReturnSwaps($pdoStatement, $swaps);
    }

    public function findAllByIsDoneAndUserMail($userMail, $isDone): array
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM tc_swap WHERE ts_is_done=:isDone AND (ts_us_mail_from=:userMail OR ts_us_mail_to=:userMail) ");
        $pdoStatement->bindValue(':userMail', $userMail, \PDO::PARAM_STR);
        $pdoStatement->bindValue(':isDone', $isDone, \PDO::PARAM_BOOL);
        $swaps = [];
        return $this->executeQueryAndReturnSwaps($pdoStatement, $swaps);
    }

    /**
     * Ajoute un troc dans la base de données.
     * @param Swap $swap
     * @return Swap
     */

    public function create($object): ?Swap
    {
        $swapCreated = null;
        if ($object instanceof Swap) {

            $pdoStatement = $this->pdo->prepare("INSERT INTO tc_swap(ts_us_mail_from, ts_us_mail_to) VALUES (:user_from, :user_to)");

            $pdoStatement->bindValue(':user_from', $object->getUserFrom(), \PDO::PARAM_STR);
            $pdoStatement->bindValue(':user_to', $object->getUserTo(), \PDO::PARAM_STR);
            $execute = $pdoStatement->execute();
            if ($execute) {
                $newSwapId = $this->pdo->lastInsertId();
                foreach ($object->getItems() as $item) {
                    if ($item instanceof Item) {
                        $this->addItemToSwap($item->getId(), $newSwapId);
                    }
                }
                $swapCreated = $this->findById($newSwapId);
            }
        }

        return $swapCreated;
    }


    /**
     * Récupère un troc
     * @param int $id
     * @return Swap | bool
     */

    public function findById($id)
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM tc_swap WHERE ts_id = :id");
        $pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
        $execute = $pdoStatement->execute();
        $swap = null;
        if ($execute) {
            $db_row = $pdoStatement->fetch();
            if ($db_row !== false) {
                $swap = new Swap($db_row[0],
                    $db_row[1],
                    $db_row[2],
                    $db_row[3],
                    $db_row[4],
                    $db_row[5],
                    $db_row[6],
                    $this->itemManager->findAllBySwapId($db_row[0]));
            }
        }
        return $swap;
    }


    /**
     * DEPRECIE
     * Refuser un troc
     * @param Swap $troc
     * @return bool
     */
    /*
        public function refuseTroc(Swap $troc) {

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
     * @param Swap $troc
     * @return bool
     */
    /*
    public function acceptTroc(Swap $troc) {

        $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_is_done = TRUE, tr_is_accepted = TRUE WHERE tr_id = :id");
        $this->pdoStatement->bindValue(':id', $troc->getId(), \PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        if ($execute) {
            return true;
        }

        return false;
    }
    */

    public function update($object)
    {
        if ($object instanceof Swap) {
            $this->pdoStatement = $this->pdo->prepare("UPDATE tc_troc SET tr_creation_date = :creationdate, tr_end_date = :enddate, tr_is_done = :isdone, tr_is_accepted = :isaccepted WHERE tr_id = :id");

            $this->pdoStatement->bindValue(':creationdate', $object->getCreationDate(), \PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':enddate', $object->getEndDate(), \PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':isdone', $object->getIsDone(), \PDO::PARAM_BOOL);
            $this->pdoStatement->bindValue(':isaccepted', $object->getStatus(), \PDO::PARAM_BOOL);
            $this->pdoStatement->bindValue(':id', $object->getId(), \PDO::PARAM_INT);

            $execute = $this->pdoStatement->execute();

            if ($execute) {
                return true;
            } else {
                return false;
            }
        }

    }



    public function deleteById($troc)
    {
        if ($troc instanceof Swap) {
            $this->pdoStatement = $this->pdo->prepare('DELETE FROM tc_troc WHERE tr_id =:id');
            $this->pdoStatement->bindValue(':id', $troc->getId(), PDO::PARAM_INT);

            return $this->pdoStatement->execute();
        }
    }

    private function addItemToSwap(int $itemId, int $swapId)
    {
        $pdostatement = $this->pdo->prepare('INSERT INTO tc_swap_item(id_swap, id_item) VALUES (:swapId, :itemId)');
        $pdostatement->bindValue(':itemId', $itemId);
        $pdostatement->bindValue(':swapId', $swapId);
        $pdostatement->execute();
    }

    /**
     * @param $pdoStatement
     * @param array $swaps
     * @return array
     */
    public function executeQueryAndReturnSwaps($pdoStatement, array $swaps): array
    {
        $pdoStatement->execute();
        $dbarray = $pdoStatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $swaps[] = new Swap($db_row[0],
                $db_row[1],
                $db_row[2],
                $db_row[3],
                $db_row[4],
                $db_row[5],
                $db_row[6],
                $this->itemManager->findAllBySwapId($db_row[0]));
        }
        return $swaps;
    }


}