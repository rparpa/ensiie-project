<?php

/**
 * Manager a pour role d'intéragir avec la base de données
 */

namespace Db;

use models\Category;
use models\User;
use PDO;


#require_once '../models/Item.php';

use models\Item;

class ItemManager extends Manager
{
    private CategoryManager $categoryManager;

    private UserManager $userManager;

    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
        $this->categoryManager = new CategoryManager($connection);
        $this->userManager = new UserManager($connection);
    }

    /**
     * recupere tous les objets de la base
     * @return Item[] qui est un tableau d'objet
     */
    public function findAll(): array
    {
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_item');
        $items = [];
        $dbarray = $pdoStatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $items[] = new Item($db_row[0],
                $db_row[1],
                $db_row[2],
                $db_row[3],
                $db_row[4],
                $db_row[5],
                $db_row[6],
                $this->categoryManager->findAllByItemId($db_row[0]));
        }
        return $items;
    }

    public function findAllByProprietaryMail($mail): array
    {
        $pdostatement = $this->pdo->prepare('SELECT * FROM tc_item WHERE it_proprietary = :proprietary');
        $pdostatement->bindValue(':proprietary', $mail);
        return $this->executeQueryAndReturnItems($pdostatement);
    }

    /**
     *
     * recupere un objet a partir de son identifiant
     * @param int $id
     * @return  item|bool retourne objet si tout va bien, false si erreur, null si il n y a pas d'objet a retourner
     */
    public function findById($id)
    {

        $pdoStatement = $this->pdo->prepare('SELECT * FROM tc_item WHERE it_id=:id');
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $execute = $pdoStatement->execute();
        $item = null;
        if ($execute) {
            $db_row = $pdoStatement->fetch();
            if ($db_row !== false) {
                $item = new Item($db_row[0],
                    $db_row[1],
                    $this->userManager->findById($db_row[2]),
                    $db_row[3],
                    $db_row[4],
                    $db_row[5],
                    $db_row[6],
                    $this->categoryManager->findAllByItemId($db_row[0]));
            }
        }
        return $item;
    }

    public function findAllBySwapId($idSwap): array
    {
        $pdostatement = $this->pdo->prepare('SELECT * FROM tc_item WHERE it_id IN (SELECT id_item FROM tc_swap_item WHERE id_swap=:swapId)');
        $pdostatement->bindValue(':swapId', $idSwap, PDO::PARAM_INT);
        return $this->executeQueryAndReturnItems($pdostatement);
    }

    public function create($object)
    {
        $createdItem = null;
        if ($object instanceof Item) {
            $pdoStatement = $this->pdo->prepare('INSERT INTO tc_item(it_name,it_proprietary,it_picture,it_description) VALUES(:name,:proprietary,:picture,:description)');
            $pdoStatement->bindValue(':name', $object->getName());
            $pdoStatement->bindValue(':proprietary', $object->getProprietary()->getMail());
            $pdoStatement->bindValue(':picture', $object->getPicture());
            $pdoStatement->bindValue(':description', $object->getDescription());
            $execute = $pdoStatement->execute();
            if ($execute) {
                $newItemId = $this->pdo->lastInsertId();
                foreach ($object->getCategories() as $category) {
                    if ($category instanceof Category) {
                        $this->categoryManager->addCategoryToItemId($category->getId(), $newItemId);
                    }
                }
                $createdItem = $this->findById($newItemId);
            }
        }
        return $createdItem;
    }

    public function searchByNameAndCategoriesId(string $recherche, $categoriesId): array
    {
        $req = "";
        $prep = array(); // tableau associatif : permet de sauvegarder les paramètre de bind value ex :id , val
        $i = 1;
        $req .= "SELECT * FROM tc_item as it WHERE LOWER(it_name) like LOWER(:recherche)";

        /*construction de la requete en fonction du nombre d'id*/
        foreach ($categoriesId as $id) {
            $req .= "AND :id$i in (select id_category from tc_item_category where id_item=it.it_id)";
            $prep[":id$i"] = $id;
            $i++;
        }

        $pdoStatement = $this->pdo->prepare($req);
        $pdoStatement->bindValue(':recherche', '%' . $recherche . '%', PDO::PARAM_STR);

        /*execution du bindValue a partir du tableau associatif $prep*/
        foreach ($categoriesId as $id) {
            $pdoStatement->bindValue(key($prep), $id, PDO::PARAM_STR);
            next($prep);//passe a la clé suivante
        }
        return $this->executeQueryAndReturnItems($pdoStatement);
    }


    /**
     * Met un jour un objet
     * @return bool
     */
    public function update($object): bool
    {

        $this->pdoStatement = $this->pdo->prepare('UPDATE tc_item set it_name=:item_name,it_proprietary=:proprietary,it_picture=:picture,it_description=:description,it_creation_date=:creation_date,it_is_swappable=:is_swappable WHERE it_id=:id');

        $this->pdoStatement->bindValue(':item_name', $object->getName(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':proprietary', $object->getProprietary(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':picture', $object->getPicture(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':description', $object->getDescription(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':creation_date', $object->getCreationDate(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':is_swappable', $object->getIsSwappable(), PDO::PARAM_BOOL);
        $this->pdoStatement->bindValue(':id', $object->getId(), PDO::PARAM_INT);

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
            return $this->create($item);
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



    public function deleteById($id)
    {
        // On ne supprime pas les objets de la base de données, car on veut garder l'historique des trocs meme refusés mais
        // donc on le rend non échangeables
        $item = $this->findById($id);
        if ($item instanceof Item) {
            $pdoStatement = $this->pdo->prepare('UPDATE tc_item SET it_is_swappable=FALSE WHERE it_id=:id');
            $pdoStatement->bindValue(':id', $id);
            $pdoStatement->execute();
        }
    }

    /**
     * @param $pdostatement
     * @return array
     */
    public function executeQueryAndReturnItems($pdostatement): array
    {
        $pdostatement->execute();
        $items = [];
        $dbarray = $pdostatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $items[] = new Item($db_row[0],
                $db_row[1],
                $this->userManager->findById($db_row[2]),
                $db_row[3],
                $db_row[4],
                $db_row[5],
                $db_row[6],
                $this->categoryManager->findAllByItemId($db_row[0]));
        }
        return $items;
    }

}