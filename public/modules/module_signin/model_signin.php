<?php

class ModeleSignin extends ModeleGenerique {

    function connection() {
        //Check si input son vide ou non, juste une assurance vu que le JS sert a empecher cela
        if (empty($_POST["pseudo"]))
            return 'Please provide a username or email address';
        else if (empty($_POST["password"]))
            return 'Please enter your password';
        else {
            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $password = hash('sha512', htmlspecialchars($_POST["password"]));
        }

        //Vérifie les données entrées
        $req = $this->connexion->prepare('SELECT idUser, private_key, public_key FROM Utilisateur WHERE (pseudo = :pseudo OR email = :pseudo) AND password = :password');
        $req->execute(array(
            'pseudo' => $pseudo,
            'password' => $password));
        $test = $req->fetch(PDO::FETCH_ASSOC); 
        
        if (!$test) //Si elles sont fausses
            return 'Wrong username, email address or password !';
        else {
            //Sinon on vérifie si l'utilisateur a été banni
            $req = $this->connexion->prepare('SELECT * FROM Blocked_Users WHERE idUser = ?');
            $req->execute(array($test["idUser"]));
            $result = $req->fetch(PDO::FETCH_ASSOC);

            //Si l'utilisateur est banni
            if (!empty($result)) {
                return "Sorry, you were banned.";
            } else {
                //On set les différentes variables de SESSION
                $_SESSION['id'] = $test["idUser"];

                $private_key = openssl_pkey_get_private($test["private_key"], $_POST["password"]);
                $private_key_string = "";
                openssl_pkey_export($private_key, $private_key_string);
                $_SESSION['private_key'] = $private_key_string;

                $_SESSION['public_key'] = $test["public_key"];

                $_SESSION['pseudo'] = $pseudo;

                //On vérifie ensuite si l'utilisateur est un administrateur
                $req = $this->connexion->prepare('SELECT * FROM Admins WHERE idUser = ?');
                $req->execute(array($_SESSION['id']));
                $result = $req->fetch(PDO::FETCH_ASSOC);

                //Si l'utilisateur est un administrateur
                if (!empty($result))
                    $_SESSION['isAdmin'] = true;
                else
                    $_SESSION['isAdmin'] = false;

                // Rechiffrer les messages si possible.
                $this->reencrypt_conversations();
            }
        }

        return NULL;
    }
}

?>
