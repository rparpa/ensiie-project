<?php

namespace Db;


use models\User;
use PDO;


class UserManager extends Manager
{
    public function __construct(PDO $connection)
    {
        /**
         * initialisation de la connexion à la base de données
         */
        $this->pdo = $connection;
    }

    public function findAll(): array
    {
        $pdoStatement = $this->pdo->query('SELECT * FROM tc_user');
        $users = [];

        $dbarray = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dbarray as $db_row) {
            $users[] = new User($db_row[0], $db_row[1], $db_row[2], $db_row[3], $db_row[4], $db_row[5], $db_row[6], $db_row[7], $db_row[8], $db_row[9], $db_row[10]);
        }

        return $users;
    }


    public function create($object): ?User
    {
        $createdUser = null;
        if ($object instanceof User) {

            $pdoStatement = $this->pdo->prepare('INSERT INTO tc_user VALUES(:mail, :firstname, :lastname, :pseudo, :password, :picture, :zipcode, :street, :city, :super_user, :is_banned)');
            $pdoStatement->bindValue(':mail', $object->getMail(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':firstname', $object->getFirstname(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':lastname', $object->getLastname(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':pseudo', $object->getPseudo(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':password', $object->getPassword(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture', $object->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':zipcode', $object->getZipcode(), PDO::PARAM_INT);
            $pdoStatement->bindValue(':street', $object->getStreet(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':city', $object->getCity(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':super_user', $object->getIsSuperUser(), PDO::PARAM_BOOL);
            $pdoStatement->bindValue(':is_banned', $object->getIsBanned(), PDO::PARAM_BOOL);
            $execute = $pdoStatement->execute();

            if ($execute) {
                $createdUser = $this->findById($object->getMail());
            }
        }
        return $createdUser;
    }

    public function findById($mail): User|null
    {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM tc_user WHERE us_mail = :mail LIMIT 1');
        $pdoStatement->bindValue(':mail', $mail, PDO::PARAM_STR);
        $execute = $pdoStatement->execute();
        $user = null;
        if ($execute) {
            $dbarray = $pdoStatement->fetch();
            if ($dbarray !== false) {
                $user = new User($dbarray[0], $dbarray[1], $dbarray[2], $dbarray[3], $dbarray[4], $dbarray[5], $dbarray[6], $dbarray[7], $dbarray[8], $dbarray[9], $dbarray[10]);
            }
        }
        return $user;
    }

    public function lock(User &$user): bool
    {
        $email = $user->getMail();
        $status = $user->getIsBanned();
        $status = $status == 1 ? 0 : 1;

        $pdoStatement = $this->pdo->prepare('UPDATE tc_user set us_is_banned=:status WHERE us_email=:email LIMIT 1');

        $pdoStatement->bindValue(':status', $status, PDO::PARAM_BOOL);
        $pdoStatement->bindValue(':email', $email, PDO::PARAM_INT);

        return $pdoStatement->execute();
    }

    public function update($user): bool
    {
        if ($user instanceof User) {

            // Récupérer les champs dans l'users de la base de données, ayant pour id le même que l'objet sur lequel il est appelé
            $user_db = $this->findById($user->getMail());

            // Si l'users n'existe pas dans la base de données, on ne peut pas faire de mise à jour
            if ($user_db === null) {
                return false;
            } // Si l'users existe dans la base de données, on peut faire la mise à jour
            else {
                // On récupère les champs de l'objet users
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

                $pdoStatement = $this->pdo->prepare('
                UPDATE tc_user 
                SET us_firstname=:firstname, us_lastname=:lastname, 
                us_pseudo=:pseudo, us_password=:password, us_picture=:picture, 
                us_zipcode=:zipcode, us_street=:street, us_city=:city, us_is_banned=:is_banned 
                WHERE us_mail=:mail');

                $pdoStatement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
                $pdoStatement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
                $pdoStatement->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
                $pdoStatement->bindValue(':password', $password, PDO::PARAM_STR);
                $pdoStatement->bindValue(':picture', $picture, PDO::PARAM_STR);
                $pdoStatement->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
                $pdoStatement->bindValue(':street', $street, PDO::PARAM_STR);
                $pdoStatement->bindValue(':city', $city, PDO::PARAM_STR);
                $pdoStatement->bindValue(':is_banned', $is_banned, PDO::PARAM_BOOL);
                $pdoStatement->bindValue(':mail', $mail, PDO::PARAM_INT);

                $execute = $pdoStatement->execute();

                if ($execute) {
                    return true;
                } else return false;

            }
        }
    }

    public function delete($user)
    {
        if ($user instanceof User) {
            $pdoStatement = $this->pdo->prepare('DELETE FROM tc_user WHERE us_mail=:mail');
            $pdoStatement->bindValue(':mail', $user->getMail(), PDO::PARAM_INT);

            return $pdoStatement->execute();
        }
    }


    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}