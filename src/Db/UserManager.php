<?php

namespace Db;

use models\Item;
use models\User;
use Db\Manager;
use PDO;

require_once '../models/User.php';


class UserManager extends Manager {
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


    public function create($user): bool
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

    public function findById($mail): User|bool|null {
        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM tc_user WHERE us_mail = :mail LIMIT 1');
        $this->pdoStatement->bindValue(':mail', $mail, PDO::PARAM_STR);
        $execute = $this->pdoStatement->execute();

        if (!$execute) {
            return false;
        } else {
            $dbarray = $this->pdoStatement->fetchAll()[0];

            if ($dbarray === false) {
                return null;
            } else {
                #print_r($dbarray);
                return new User($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3], $dbarray[4], $dbarray[5], $dbarray[6], $dbarray[7], $dbarray[8], $dbarray[9], $dbarray[10]);
            }
        }
    }

    public function lock(User &$user): bool {
        $email=$user->getMail();
        $status = $user->getIsBanned();
        $status = $status == 1 ? 0 : 1;
        $user->setIsBanned($status);

        $this->pdoStatement = $this->pdo->prepare('UPDATE tc_user set us_is_banned=:status WHERE us_mail=:email');

        $this->pdoStatement->bindValue(':status', $status, PDO::PARAM_BOOL);
        $this->pdoStatement->bindValue(':email', $email, PDO::PARAM_INT);

        return $this->pdoStatement->execute();
    }

    public function update($user): bool {

        // Récupérer les champs dans l'user de la base de données, ayant pour id le même que l'objet sur lequel il est appelé
        $user_db = $this->select($user->getMail());

        // Si l'user n'existe pas dans la base de données, on ne peut pas faire de mise à jour
        if ($user_db === null) {
            return false;
        } // Si l'user existe dans la base de données, on peut faire la mise à jour
        else {
            // On récupère les champs de l'objet user
            $mail = $user->getMail();
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $pseudo = $user->getPseudo();
            $password = $user->getPassword();
            $picture = $user->getPicture();
            $zipcode = $user->getZipcode();
            $street = $user->getStreet();
            $city = $user->getCity();
            $is_banned = $user->getIsBanned();


            // On modifie tout, mais finalement seuls les champs qui ont été modifiés sont mis à jour

            $this->pdoStatement = $this->pdo->prepare('
            UPDATE tc_user 
            SET us_firstname=:firstname, us_lastname=:lastname, 
            us_pseudo=:pseudo, us_password=:password, us_picture=:picture, 
            us_zipcode=:zipcode, us_street=:street, us_city=:city, us_is_banned=:is_banned 
            WHERE us_mail=:mail');

            $this->pdoStatement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':password', $password, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':picture', $picture, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':street', $street, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':city', $city, PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':is_banned', $is_banned, PDO::PARAM_BOOL);
            $this->pdoStatement->bindValue(':mail', $mail, PDO::PARAM_INT);

            $execute = $this->pdoStatement->execute();

            if ($execute) {
                return true;
            } else return false;

        }
    }

    public function delete($object) {

        $this->pdoStatement = $this->pdo->prepare('DELETE FROM tc_user WHERE us_mail=:mail');
        $this->pdoStatement->bindValue(':mail', $object->getMail(), PDO::PARAM_INT);

        return $this->pdoStatement->execute();
    }

    public function findAll() : array {
        $this->pdoStatement = $this->pdo->query('SELECT * FROM tc_user');
        $users = [];

        $dbarray = $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dbarray as $db_row) {
            $users[] = new User($db_row[0], $db_row[1], $db_row[2], $db_row[3], $db_row[4], $db_row[5], $db_row[6], $db_row[7], $db_row[8], $db_row[9], $db_row[10]);
        }

        return $users;
    }


    public function selectByUsername($username) {
        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM tc_user WHERE us_pseudo = :username LIMIT 1');
        $this->pdoStatement->bindValue(':username', $username, PDO::PARAM_STR);
        $execute = $this->pdoStatement->execute();

        if (!$execute) {
            return false;
        } else {
            $dbarray = $this->pdoStatement->fetchAll()[0];

            if ($dbarray === false) {
                return null;
            } else {
                #print_r($dbarray);
                return new User($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3], $dbarray[4], $dbarray[5], $dbarray[6], $dbarray[7], $dbarray[8], $dbarray[9], $dbarray[10]);
            }
        }
    }


}