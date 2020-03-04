<?php

class ModeleFlag extends ModeleGenerique {

    function getFlaggedMessages() {
        $tab = array();

        $req = $this->connexion->prepare("SELECT pseudo, idMessage, contenu FROM Utilisateur INNER JOIN (Flagged_Messages INNER JOIN Message USING(idMessage)) USING(idUser)");
        $req->execute();

        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            $message = $this->decryptMessage($result['idMessage'], $result['contenu']);
            if ($message !== null){
                if (array_key_exists($result['pseudo'], $tab)) {
                    $tab[$result['pseudo']][] = $message;
                }
                else{
                    $tab[$result['pseudo']] = array($message);
                }
            }
        }
        return $tab;
    }

    function unleashHell() {
        $tab = $this->getFlaggedMessages();
        $time = array(300, 3600, 14400, 43200, 86400, 31536000);

        foreach($_POST as $key=>$value) {
            $value = (int) $value;
            if (array_key_exists($key, $tab)) { //secu
                if ($value != 0) {
                    $req = $this->connexion->prepare("INSERT INTO Blocked_Users values (DEFAULT, (SELECT idUser FROM Utilisateur WHERE pseudo = :pseudo), DEFAULT, TIMESTAMPADD(SECOND, :temps, current_timestamp))");
                    $data = array(
                        'pseudo' => $key,
                        'temps' => $time[$value-1]);
                    $stmt = $req->execute($data);

                    if (!$stmt)
                        return 'Something went wrong !';
                }

                $req = $this->connexion->prepare("DELETE FROM Flagged_Messages WHERE idMessage IN (SELECT idMessage FROM Utilisateur INNER JOIN Message USING(idUser) WHERE pseudo = ?)");
                $data = array($key); 
                $stmt = $req->execute($data);

                if (!$stmt)
                    return 'Something went wrong !';
            }
        }
        return NULL;
    }
}

?>
