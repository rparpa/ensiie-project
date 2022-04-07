<?php

namespace Db;
use models\Category;
use models\Item;
use PDO;

class CategoryManager
{

    private PDO $pdo;
    private $pdoStatement;


    public function __construct(PDO $connection)
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $this->pdo = $connection;
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
        $this->pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
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
     * @return Category[] qui est un tableau d'objet
     */
    public function selectAll(): array
    {
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_category ORDER BY ca_name ASC');
        return $this->convertRowsToCategoriesArray($this->pdoStatement->fetchAll());
    }

    /**
     * recupere ous les objets de la base
     * @return Category[] qui est un tableau d'objet
     */
    public function selectFiveBestCategories(): array
    {
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_category ORDER BY ca_number_swap DESC LIMIT 5');
        return $this->convertRowsToCategoriesArray($this->pdoStatement->fetchAll());
    }

    private function convertRowsToCategoriesArray($dbarray): array
    {
        foreach ($dbarray as $db_row) {
            $categories[] = new Category($db_row[0], $db_row[1], $db_row[2]);
        }
        return $categories;
    }

}