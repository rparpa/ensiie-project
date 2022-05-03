<?php

/**
 * Manager a pour role d'intéragir avec la base de données pour gérer les trocs.
 */

namespace Db;

use models\Item;
use models\Swap;
use Db\Manager;
use models\SwapStatistique;
use models\User;
use PDO;

class SwapManager extends Manager
{


    private ItemManager $itemManager;

    private UserManager $userManager;

    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
        $this->itemManager = new ItemManager($connection);
        $this->userManager = new UserManager($connection);
    }

    public function findAll(): array
    {
        $swaps = [];
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_swap');
        return $this->executeQueryAndReturnSwaps($pdoStatement, $swaps);
    }

    public function findAllOrderByEndDateDescLimit10(): array
    {
        $swaps = [];
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_swap WHERE ts_end_date IS NOT NULL AND ts_tss_id=1 ORDER BY ts_end_date DESC LIMIT 10');
        return $this->executeQueryAndReturnSwaps($pdoStatement, $swaps);
    }

    public function findAllByIsDoneAndUserMail($userMail, $isDone): array
    {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM tc_swap WHERE ts_is_done=:isDone AND (ts_us_mail_from=:userMail OR ts_us_mail_to=:userMail) ORDER BY ts_end_date DESC");
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

            $pdoStatement->bindValue(':user_from', $object->getUserFrom()->getMail(), \PDO::PARAM_STR);
            $pdoStatement->bindValue(':user_to', $object->getUserTo()->getMail(), \PDO::PARAM_STR);
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
                    $this->userManager->findById($db_row[5]),
                    $this->userManager->findById($db_row[6]),
                    $this->itemManager->findAllBySwapId($db_row[0]));
            }
        }
        return $swap;
    }


    public function update($object)
    {
        // L'update a uniquement pour rôle de fermer le troc avec son statut REUSSITE ou ECHEC
        $swap = null;
        if ($object instanceof Swap) {
            $swap = $this->findById($object->getId());
            if ($swap != null) {
                $swap->setStatus($object->getStatus());
                $pdoStatement = $this->pdo->prepare("UPDATE tc_swap SET ts_tss_id = :new_status, ts_is_done=TRUE, ts_end_date=CURRENT_DATE WHERE ts_id = :id");
                $pdoStatement->bindParam(':new_status', $swap->status, PDO::PARAM_INT);
                $pdoStatement->bindParam(':id', $swap->id, PDO::PARAM_INT);
                $execute = $pdoStatement->execute();
                if ($execute) {
                    $swap = $this->findById($swap->id);
                }
            }
        }
        return $swap;
    }


    public function getStatistiquesLastSevenDays(): array
    {
        $pdoStatement = $this->pdo->query("SELECT date as date, sum(case when ts_tss_id = 1 then 1 else 0 end) validate, 
                                        sum(case when ts_tss_id = 2 then 1 else 0 end) cancel
                                        FROM CALENDAR_LAST_SEVEN_DAYS
                                        LEFT JOIN tc_swap tsi on CALENDAR_LAST_SEVEN_DAYS.date = tsi.ts_end_date
                                        AND ts_is_done=true
                                        GROUP BY date ORDER BY date");
        $statistiques = [];
        $pdoStatement->execute();
        $dbarray = $pdoStatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $statistiques[] = new SwapStatistique($db_row[0],
                $db_row[1],
                $db_row[2]);
        }
        return $statistiques;
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
                $this->userManager->findById($db_row[5]),
                $this->userManager->findById($db_row[6]),
                $this->itemManager->findAllBySwapId($db_row[0]));
        }
        return $swaps;
    }


}