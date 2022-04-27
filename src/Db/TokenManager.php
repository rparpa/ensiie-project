<?php


namespace Db;


use auth\JWT;
use models\Token;
use PDO;
require_once '../auth/key.php';

class TokenManager extends Manager
{
    public function __construct(PDO $connection)
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $this->pdo = $connection;
    }

    public function findByToken(string $token): Token|null
    {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM tc_token WHERE tr_token=:token LIMIT 1');
        $pdoStatement->bindValue(':token', $token, PDO::PARAM_STR);
        $execute = $pdoStatement->execute();

        if ($execute) {
            $dbarray = $pdoStatement->fetch();
            if ($dbarray === false) {
                return null;
            } else
                $jwt = new JWT();
            if ($jwt->isValid($token) && $jwt->check($token, SECRET) && !$jwt->isExpired($token)) {
                return new Token($dbarray[0], $dbarray[1]);
            }

        }
        return null;
    }

    public function create($object)
    {
        $createdItem = null;
        if ($object instanceof Token) {
            $pdoStatement = $this->pdo->prepare('INSERT INTO tc_token VALUES(:token,:mail)');
            $pdoStatement->bindValue(':mail', $object->getUserMail());
            $pdoStatement->bindValue(':token', $object->getToken());
            $execute = $pdoStatement->execute();
            if ($execute) {
                $createdItem = $this->findByToken($object->getToken());
            }
        }
        return $createdItem;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }



    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}