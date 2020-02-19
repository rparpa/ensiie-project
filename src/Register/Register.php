<?php
namespace Register;
use PDO;

class Register {
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
