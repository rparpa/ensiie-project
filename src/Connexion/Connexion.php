<?php
namespace Connexion;
use PDO;

class Connexion {
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

	public function deconnexion() {
		session_destroy();
	}
}
