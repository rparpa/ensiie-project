<?php

/**
 * Manager a pour role d'intéragir avec la base de données
 */

namespace Db;
use PDO;


#require_once '../models/Item.php';

use models\Item;

class ItemManager
{

    private PDO $pdo;
    private $pdoStatement;


    public function __construct(PDO $connection)
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $this->pdo=$connection;
    }

    /**
     *
     * inserer un objet dans la base en mettant à jour l'objet en lui précisant un id
     * @param Item passage de objet par reference
     * @return bool
     *
     *
     */
    public function insert(Item &$item): bool
    {
        /**
         * id NULL car il est en auto_increment
         */
        $this->pdoStatement = $this->pdo->prepare('INSERT INTO tc_item(it_proprietary,it_picture,it_description,it_creation_date,it_is_swappable) VALUES(:proprietary,:picture,:description,:creation_date,:is_swappable)');
        $this->pdoStatement->bindValue(':proprietary', $item->getProprietary(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':picture', $item->getPicture(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':description', $item->getDescription(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':creation_date', $item->getCreationDate(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':is_swappable', $item->getIsSwappable(), PDO::PARAM_BOOL);

        $execute = $this->pdoStatement->execute();

        if (!$execute) {
            return false;
        } else {
            /*
             * recuperer l'objet inserer et l'affecter a item et pour ça il faut recup l'identifiant créé
             */
            //$id = $this->pdo->lastInsertId();
            //$item = $this->select($id);
            return true;
        }
    }


    /**
     *
     * recupere un objet a partir de son identifiant
     * @param int $id
     * @return  item|bool retourne objet si tout va bien, false si erreur, null si il n y a pas d'objet a retourner
     */

    public function select(int $id)
    {

        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM tc_item WHERE it_id=:id');
        $this->pdoStatement->bindValue(':id',$id, PDO::PARAM_INT);
        $execute = $this->pdoStatement->execute();

        if ($execute) {
            $item = $this->pdoStatement->fetchObject('models\Item');

            if ($item === false) {
                return null;
            } else {
                return $item;
            }

        }
        return false;
    }


    /**
     * recupere ous les objets de la base
     * @return Item[] qui est un tableau d'objet
     */
    public function selectAll(): array
    {
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_item');
        $items = [];

        while ($item = $this->pdoStatement->fetchObject('models\Item')) {
            $items[] = $item;
        }
        return $items;
    }

    /**
     * Met un jour un objet
     * @return bool
     */
    private function update(Item $item)
    {

        $this->pdoStatement = $this->pdo->prepare('UPDATE tc_item set it_proprietary=:proprietary,it_picture=:picture,it_description=:description,it_creation_date=:creation_date,it_is_swappable=:is_swappable WHERE it_id=:id');

        $this->pdoStatement->bindValue(':proprietary', $item->getProprietary(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':picture', $item->getPicture(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':description', $item->getDescription(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':creation_date', $item->getCreationDate(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':is_swappable', $item->getIsSwappable(), PDO::PARAM_BOOL);
        $this->pdoStatement->bindValue(':id', $item->getId(), PDO::PARAM_INT);

        return $this->pdoStatement->execute();

    }

    /**
     * Methode utilise par le client
     * @param Item $item
     * @return bool
     */
    public function save(Item &$item): bool
    {
        if (is_null($item->getId())) {
            return $this->insert($item);
        } else {
            return $this->update($item);
        }
    }


    /**
     * Supprime un objet stocke en bdd
     * @param Item $item
     * @return bool
     */

    public function delete(Item $item): bool
    {
        $this->pdoStatement = $this->pdo->prepare('DELETE FROM tc_item WHERE it_id = :id');
        $this->pdoStatement->bindValue(':id', $item->getId(), PDO::PARAM_INT);

        return $this->pdoStatement->execute();
    }

    public function getItemByProprietary($proprietary)
    {
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_item WHERE tc_proprietary = :proprietary');
        $items = [];

        while ($item = $this->pdoStatement->fetchObject('models\Item')) {
            $items[] = $item;
        }
        return $items;
    }


}