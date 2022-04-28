<?php

use Db\UserManager;
use models\User;

require_once '../vendor/autoload.php';
require_once '../src/Bootstrap.php';
include_once '../src/auth/generate.php';

if (isset($_GET['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $userManager = new UserManager();
        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            $password_hashed = hash("sha384", $_POST['password']); // Ne peut normalement pas renvoyer false car on lui donne bien une string
            // et pas autre chosee et ne peut pas renvoyer null puisque l'algorithme donné en paramètre est valide
            if ($doUserExists->getPassword() === $password_hashed) {
                header('Location: actions/create-token.php?email=' . $_POST["email"]);
            } else {
                header('Location: index.php?unknownUser');
            }
        } else {
            header('Location: index.php?unknownUser');
        }
    }
}
if (isset($_GET['signup'])) {
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['photo-de-profil']) && isset($_POST['adresse']) && isset($_POST['code-postal']) && isset($_POST['ville'])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password_hashed = hash("sha384", $_POST['password']);
        // Ne peut normalement pas renvoyer false car on lui donne bien une string et pas autre chosee et ne peut pas renvoyer null
        // puisque l'algorithme donné en paramètre est valide
        $ville = $_POST['ville'];
        $codePostal = $_POST['code-postal'];
        $adresse = $_POST['adresse'];
        $PDP = $_POST['photo-de-profil'];

        $userManager = new UserManager();

        //Ne pas oublier de faire la manip du chemin pour la photo de profil

        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            header('Location: sign-up-form.php?alreadyExists');
        } else {
            $createdUser = $userManager->create(new User($email, $prenom, $nom, $pseudo, $password_hashed, $PDP, $codePostal, $adresse, $ville, false, false));
            header('Location: actions/create-token.php?email=' . $_POST["email"]);
        }
    }
    // On ne peut pas avoir une erreur de champ non rempli puisque j'ai mis des required dans le html
}
echo '<html lang="fr">
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>';
echo '</html>';
