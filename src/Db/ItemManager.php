<?php


namespace Db;

use models\Category;
use models\User;
use PDO;


use models\Item;

class ItemManager extends Manager
{
    private CategoryManager $categoryManager;

    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
        $this->categoryManager = new CategoryManager($connection);
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
                $dbarray[6],
                $this->categoryManager->findAllByItemId($db_row[0]));
        }
        return $items;
    }

    public function findAllByProprietaryMail($mail): array
    {
        $pdostatement = $this->pdo->prepare('SELECT * FROM tc_item WHERE it_proprietary = :proprietary');
        $pdostatement->bindValue(':proprietary', $mail);
        $pdostatement->execute();
        $items = [];
        $dbarray = $pdostatement->fetchAll();
        foreach ($dbarray as $db_row) {
            $items[] = new Item($db_row[0],
                $db_row[1],
                $db_row[2],
                $db_row[3],
                $db_row[4],
                $db_row[5],
                true,
                $this->categoryManager->findAllByItemId($db_row[0]));
        }
        return $items;
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
                    $db_row[2],
                    $db_row[3],
                    $db_row[4],
                    $db_row[5],
                    $db_row[6],
                    $this->categoryManager->findAllByItemId($db_row[0]));
            }
        }
        return $item;
    }

    public function create($object)
    {
        $createdItem = null;
        if ($object instanceof Item) {
            $pdoStatement = $this->pdo->prepare('INSERT INTO tc_item(it_name,it_proprietary,it_picture,it_description) VALUES(:name,:proprietary,:picture,:description)');
            $pdoStatement->bindValue(':name', $object->getName());
            $pdoStatement->bindValue(':proprietary', $object->getProprietary());
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


    /**
     * Met un jour un objet
     * @return bool
     */
    /*  private function update(Item $item)
      {

          $this->pdoStatement = $this->pdo->prepare('UPDATE tc_item set it_name=:name,it_proprietary=:proprietary,it_picture=:picture,it_description=:description,it_creation_date=:creation_date,it_is_swappable=:is_swappable WHERE it_id=:id');
          $this->pdoStatement->bindValue(':name', $item->getName(), PDO::PARAM_STR);
          $this->pdoStatement->bindValue(':proprietary', $item->getProprietary(), PDO::PARAM_STR);
          $this->pdoStatement->bindValue(':picture', $item->getPicture(), PDO::PARAM_STR);
          $this->pdoStatement->bindValue(':description', $item->getDescription(), PDO::PARAM_STR);
          $this->pdoStatement->bindValue(':creation_date', $item->getCreationDate(), PDO::PARAM_STR);
          $this->pdoStatement->bindValue(':is_swappable', $item->getIsSwappable(), PDO::PARAM_BOOL);
          $this->pdoStatement->bindValue(':id', $item->getId(), PDO::PARAM_INT);

          return $this->pdoStatement->execute();

      } */

    /**
     * Methode utilise par le client
     * @param Item $item
     * @return bool
     */
    /*  public function save(Item &$item): bool
      {
          if (is_null($item->getId())) {
              return $this->insert($item);
          } else {
              return $this->update($item);
          }
      } */


    /**
     * Supprime un objet stocke en bdd
     * @param Item $item
     * @return bool
     */

    /* public function delete(Item $item): bool
     {
         $this->pdoStatement = $this->pdo->prepare('DELETE FROM tc_item WHERE it_id = :id');
         $this->pdoStatement->bindValue(':id', $item->getId(), PDO::PARAM_INT);

         return $this->pdoStatement->execute();
     }  */


    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($id)
    {
        $item = $this->findById($id);
        if ($item instanceof Item && $item->getIsSwappable()) {
            $pdoStatement = $this->pdo->prepare('DELETE FROM tc_item WHERE it_id=:id');
            $pdoStatement->bindValue(':id', $id);
            $pdoStatement->execute();
        }
    }
}