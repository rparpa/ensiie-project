<?php

class ModeleConversations extends ModeleGenerique {

	function getConversations() {
		$tab = array();

        $req = $this->connexion->prepare("SELECT nomConv, cleConversation FROM Conversation INNER JOIN Participe USING(cleConversation) WHERE Participe.idUser = ?");
        $req->execute(array($_SESSION['id']));

        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            $tab[$result["cleConversation"]] = $result["nomConv"];
        }

        return $tab;
	}
}

?>
