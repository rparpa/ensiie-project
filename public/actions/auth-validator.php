<?php

use Db\Connection;
use Db\TokenManager;
use Db\UserManager;
use models\Token;
use models\User;

require_once '../../vendor/autoload.php';
include_once '../../src/auth/generate.php';

if (isset($_GET['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $userManager = new UserManager(Connection::get());
        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            $password_hashed = hash("sha384", $_POST['password']); // Ne peut normalement pas renvoyer false car on lui donne bien une string
            // et pas autre chosee et ne peut pas renvoyer null puisque l'algorithme donné en paramètre est valide
            if ($doUserExists->getPassword() === $password_hashed && !$doUserExists->getIsBanned()) {
                $tokenManager = new TokenManager(Connection::get());
                $result = $tokenManager->create(new Token(generateUserInfosArraysJWT($_POST["email"]), $_POST["email"]));
                if ($result != null) {
                    echo '<script type="text/javascript">';
                    echo 'localStorage.setItem("token","' . $result->getToken() . '");';
                    echo 'document.location.href="../user-pages/accueil.php";';
                    echo '</script>';
                }
            } else {
                header('Location: ../index.php?unknownUser');
            }
        } else {
            header('Location: ../index.php?unknownUser');
        }
    }
}
if (isset($_GET['signup'])) {
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['adresse']) && isset($_POST['code-postal']) && isset($_POST['ville'])
        && isset($_FILES['file'])) {
        $imagesLocation = 'images/users/';
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        $file = "";
        if (in_array($extension, $extensions)) {
            $uniqueName = uniqid('', true);
            $file = $uniqueName . "." . $extension;
            move_uploaded_file($tmpName, $imagesLocation . $file);
        }
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

        $userManager = new UserManager(Connection::get());

        $doUserExists = $userManager->findById($email);
        if ($doUserExists != null) {
            header('Location: ../sign-up-form.php?alreadyExists');
        } else {
            $createdUser = $userManager->create(new User($email, $prenom, $nom, $pseudo, $password_hashed, $file, $codePostal, $adresse, $ville, false, false));
            $tokenManager = new TokenManager(Connection::get());
            $result = $tokenManager->create(new Token(generateUserInfosArraysJWT($_POST["email"]), $_POST["email"]));
            if ($result != null) {
                echo '<script type="text/javascript">';
                echo 'localStorage.setItem("token","' . $result->getToken() . '");';
                echo 'document.location.href="../user-pages/accueil.php";';
                echo '</script>';
            }
        }
    }
    // On ne peut pas avoir une erreur de champ non rempli puisque j'ai mis des required dans le html
}
echo '<html lang="fr">
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>';
echo '</html>';
