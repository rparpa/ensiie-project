<?php

namespace Db;

use PDO;

abstract class Manager
{

    protected PDO $pdo;

    public function __construct(PDO $connection)
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $this->pdo = $connection;
    }

    public abstract function findAll();

    public abstract function findById($id);

    public abstract function create($object);

    public abstract function update($object);

    public abstract function delete($object);

}