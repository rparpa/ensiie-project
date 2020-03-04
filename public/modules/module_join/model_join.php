<?php

class ModeleJoin extends ModeleGenerique {

	function joinConversation() {
		$key = null;

		if(!isset($_POST['key']))
			return 'Please provide your key';
		else
			$key = htmlspecialchars($_POST['key']);

		$req = $this->connexion->prepare('SELECT cleConversation FROM Conversation WHERE cleConversation = ?');
		$req->execute(array($key));
		$result = $req->fetch(PDO::FETCH_ASSOC);
		
		if (empty($result))
			return 'Wrong key, please check your key !';
		else {
			$req = $this->connexion->prepare('SELECT idUser FROM Participe WHERE cleConversation = ?');
			$req->execute(array($key));
			
			$id = $_SESSION['id'];

			foreach ($req as $row) {
				// if(isset($row['idUser'])) {
				if($row['idUser'] == $_SESSION['id']) 
					return "You're already in that room !";
				// }
			}

			$req = $this->connexion->prepare('INSERT INTO Participe (cleConversation, idUser) VALUES (:key, :idsession)');
			$test = $req->execute(array(
				':key' => $key,
				':idsession' => $id));

			if(!$test)
				return 'Erreur';
		}

		return NULL;
	}
}

?>