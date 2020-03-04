<?php

class ModeleAddadmin extends ModeleGenerique {
    function registerAdmin () {
        if (empty($_POST["pseudo"]))
            return "Please enter a username";
        else
            $pseudo = htmlspecialchars($_POST["pseudo"]);

        $req = $this->connexion->prepare('SELECT * FROM Utilisateur WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $test = $req->fetch(PDO::FETCH_ASSOC); 

        if (!$test)
            return "The username doesn't exist !";
        else {
            if ($test["Email"] == NULL)
                return "Sorry, an administrator must have an email address";

            $req = $this->connexion->prepare("INSERT INTO Admins (idAdmin, idUser, Email, Fonction) VALUES (DEFAULT, :idUser, :email, NULL) ");
            $data = array(
                ":idUser" => $test['idUser'], 
                ":email" => $test['Email']); 
            $test = $req->execute($data);
            
            if (!$test) {
                return 'Sorry, something went wrong';
            }
        }

        return NULL;
    }
}

?>
