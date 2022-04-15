<?php

namespace Db;

use PDO;

require_once '../models/User.php';


class UserManager
{
    public function __construct()
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $this->pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    }


    public function add(User &$user): bool
    {

        $this->pdoStatement = $this->pdo->prepare('INSERT INTO tc_user VALUES(:mail, :firstname, :lastname, :pseudo, :password, :picture, :zipcode, :street, :city, :super_user, :is_banned)');
        $this->pdoStatement->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':picture', $user->getPicture(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':zipcode', $user->getZipcode(), PDO::PARAM_INT);
        $this->pdoStatement->bindValue(':street', $user->getStreet(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':city', $user->getCity(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':super_user', $user->getIsSuperUser(), PDO::PARAM_BOOL);
        $this->pdoStatement->bindValue(':is_banned', $user->getIsBanned(), PDO::PARAM_BOOL);

        $execute = $this->pdoStatement->execute();

        if (!$execute) {
            return false;
        } else {
            /*rajouter  id ?
            $id = $this->pdo->lastInsertId();
            $user = $this->select($id);
            */
            return true;
        }

    }

    public function lock(){
        $email=$this->getMail();
        $status = $this->getIsBanned();
        $status = $status == 1 ? 0 : 1;

        $this->pdoStatement = $this->pdo->prepare('UPDATE tc_user set us_is_banned=:status WHERE us_email=:email LIMIT 1');

        $this->pdoStatement->bindValue(':status', $status, PDO::PARAM_BOOL);
        $this->pdoStatement->bindValue(':email', $email, PDO::PARAM_INT);

        return $this->pdoStatement->execute();
    }

    public function edit(){


    }


    public function getUsers(){

    }

    public function getUserByEmail(){

    }

    public function getUserByUsername(){

    }


}