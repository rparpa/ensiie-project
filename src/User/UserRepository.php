<?php
namespace User;
use PDO;

class UserRepository
{
    /**
     * @var \PDO
     */
    private PDO $connection;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday));

            $users[] = $user;
        }

        return $users;
    }

    public function identification($post) {
		$statement = $this->connection->prepare("SELECT * FROM \"user\" where email=:email");
		$statement->bindParam(":email",$post["email"]);

		try {
			$statement->execute();
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			if(password_verify($post["password"],$result["password"])) {
				$_SESSION["id_user"] = $result["id"];
				$_SESSION["name_firstname"] = $result["lastname"] . " " . $result["firstname"];
				return true;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
    }
    
    public function enregistrement($post) {
		$statement = $this->connection->prepare("INSERT INTO \"user\" (firstname,lastname,email,password,birthday) values(:firstname,:lastname,:email,:password,:birthday)");	

		$statement->bindParam(":firstname",$post["firstname"]);
		$statement->bindParam(":lastname",$post["lastname"]);
		$statement->bindParam(":email",$post["email"]);
		$statement->bindParam(":birthday",$post["birthday"]);
		$mdp = password_hash($post["password"],PASSWORD_DEFAULT);
		$statement->bindParam(":password",$mdp);

		// manque des verifications not null dans le schema sql
		// modifier varchar mdp en 256
		try {
			return $statement->execute();
		} catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function deconnexion() {
		session_destroy();
	}


}
