<?php

class ModeleRegister extends ModeleGenerique {
    
	function registerUser() {
        $message = null;

        //Check si input son vide ou non, juste une assurance vu que le JS sert a empecher cela
        if (empty($_POST["pseudo"]))
            return 'Please enter your pseudo';
        else if (empty($_POST["password"]))
            return 'Please enter a valid password'; 
        else {
            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $password = hash('sha512',htmlspecialchars($_POST["password"]));
        }

        //On regarde si l'email est set sinon on le met à NULL
        if (!empty($_POST["email"]))
            $email = htmlspecialchars($_POST["email"]);   
        else
            $email = NULL; 

        $private_key = openssl_pkey_new();
        $public_key = openssl_pkey_get_details($private_key)['key'];
        $private_key_string = '';
        openssl_pkey_export($private_key, $private_key_string, $_POST["password"]);
        $req = $this->connexion->prepare("INSERT INTO Utilisateur (idUser, pseudo, password, email, private_key, public_key) VALUES (DEFAULT, :pseudo , :password, :email, :private_key, :public_key)");
        $test = $req->execute(array(
            ":pseudo" => $pseudo, 
            ":password" => $password, 
            ":email" => $email,
            ":private_key" => $private_key_string,
            ":public_key" => $public_key));

		if (!$test) {
            return 'Email or username already taken';
        } else {

            $res = $this->connexion->prepare('SELECT idUser FROM Utilisateur WHERE pseudo = :pseudo');
            $res->execute(array(':pseudo' => $pseudo));
            $resultat = $res->fetch()['idUser'];
            $_SESSION['id'] = $resultat;

            $private_key_string_unencrypted = "";
            openssl_pkey_export($private_key, $private_key_string_unencrypted);
            $_SESSION['private_key'] = $private_key_string_unencrypted;
            $_SESSION['public_key'] = $public_key;

            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['isAdmin'] = false;
        }

        return null; 
	}
}

?>
