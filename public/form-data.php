<?php

use Db\Connection;
use Db\UserManager;
use models\User;

require_once '../vendor/autoload.php';
require_once '../src/Bootstrap.php';
include_once '../src/auth/generate.php';

if (isset($_GET['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        //$password = stripslashes($_POST['password']);
        $userManager = new UserManager();
        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            $password_hashed = hash("sha384", $_POST['password']); // Ne peut normalement pas renvoyer false car on lui donne bien une string
            // et pas autre chosee et ne peut pas renvoyer null puisque l'algorithme donné en paramètre est valide
            if ($doUserExists->getPassword() === $password_hashed) {
                if (empty($_SESSION['token'])) {
                    try {
                        echo '<script type="text/javascript">';
                        echo 'localStorage.setItem("token","' . generateUserInfosArraysJWT($email) . '");';
                        echo 'document.location.href="user-pages/accueil.php";';
                        echo '</script>';

                    } catch (Exception $e) {
                    }
                }
            }
        } else {
            header('Location: index.php?unknownUser');
        }
    }
}
if (isset($_GET['signup'])) {
    echo '<html lang="fr">
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>';
    echo "Création utilisateur";
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['photo-de-profil']) && isset($_POST['adresse']) && isset($_POST['code-postal']) && isset($_POST['ville'])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password_hashed = hash("sha384", $_POST['password']); // Ne peut normalement pas renvoyer false car on lui donne bien une string
        // et pas autre chosee et ne peut pas renvoyer null puisque l'algorithme donné en paramètre est valide
        $ville = $_POST['ville'];
        $codePostal = $_POST['code-postal'];
        $adresse = $_POST['adresse'];
        $PDP = $_POST['photo-de-profil'];
        $userManager = new UserManager();
        //$_SESSION["IsayamaTeVoitJonathan"] = $password_hashed;

        //Ne pas oublier de faire la manip du chemin pour la photo de profil
        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            header('Location: sign-up-form.php?alreadyExists');
        } else {
            $createdUser = $userManager->create(new User($email, $prenom, $nom, $pseudo, $password_hashed, $PDP, $codePostal, $adresse, $ville, false, false));
            if (empty($_SESSION['token'])) {
                try {
                    $_SESSION['token'] = generateUserInfosArraysJWT($email);
                    // Redirection vers l'accueil du site
                    header('Location: user-pages/accueil.php');
                } catch (Exception $e) {
                }
            }
            // Redirection vers l'accueil
            //header('Location: user-pages/accueil.php');
        }
    } else {
        // Redirection erreur
        echo "erreur";
    }
}

echo '</html>';
