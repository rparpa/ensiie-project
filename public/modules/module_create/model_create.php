<?php

class ModeleCreate extends ModeleGenerique {
    function getConversationsByKey($key) {
        $req = $this->connexion->prepare('SELECT * FROM Conversation WHERE cleConversation = ?');
        $req->execute(array($key));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    function generateKey() {
        do {
            $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));
            $key = $pool[mt_rand(0, count($pool) - 1)];

            for($i = 0; $i < 20; $i++) {
                $key .= $pool[mt_rand(0, count($pool) - 1)];
            }

            $result = $this->getConversationsByKey($key);
        } while ($result);

        return $key;
	}

	function saveConversationID($key) {
        $name = htmlspecialchars($_POST['name']);
        $id = $_SESSION['id']; 

        $req = $this->connexion->prepare('SELECT * FROM Conversation WHERE nomConv = ?');
        $req->execute(array($name));
        $p = $req->fetch(PDO::FETCH_ASSOC);

        if ($p != false)
            return 'Sorry, this name is already taken';
        
        $req = $this->connexion->prepare("INSERT INTO Conversation (cleConversation, dateCreation, nomConv, idUser) VALUES (:cle ,DEFAULT, :nom, :id ) ");
		$data = array(
            ":cle" => $key,
            ":nom" => $name ,
            ":id" => $id);
        $tmp = $req->execute($data);

        if (!$tmp)
            return 'An error occurred, please try again'; 
        
        return NULL;
	}
}

?>
