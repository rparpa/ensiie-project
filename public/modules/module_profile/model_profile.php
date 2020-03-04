<?php 

class ModeleProfile extends ModeleGenerique {
    
	function getProfileInfo() {
        if (isset($_GET["u"]) && !empty($_GET["u"])) {
            $user = htmlspecialchars($_GET["u"]);

            $req = $this->connexion->prepare('SELECT idUser FROM Utilisateur WHERE pseudo = ?');
            $req->execute(array($user));
            $test = $req->fetch(PDO::FETCH_ASSOC); 
            
            if (!$test) //Si elles sont fausses
                $user = $_SESSION['pseudo'];
        } else
            $user = $_SESSION['pseudo'];

        $req = $this->connexion->prepare("SELECT idUser, pseudo, Email, description, Name, Gender, Age, Occupation, Location, Quote FROM Utilisateur WHERE pseudo = ?");
        $req->execute(array($user));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        return $result; 
    }
}

?>
