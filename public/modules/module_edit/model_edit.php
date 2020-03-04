<?php

class ModeleEdit extends ModeleGenerique {

    function getProfileInfo() {
        $req = $this->connexion->prepare("SELECT Email, Description, Name, Gender, Age, Occupation, Location, Quote FROM Utilisateur WHERE pseudo = ?");
        $req->execute(array($_SESSION['pseudo']));
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //
    // /!\ ATTENTION: Même fonction que dans model_chat si on avait eu le temps on aurait trouvé un moyen de ne pas avoir de tel duplication de code
    //
    function sendFile() { 
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (!isset($_FILES["file"]["tmp_name"]) || empty($_FILES["file"]["tmp_name"])) {
            return "Sorry there was a problem with your file";
        }

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check == false) {
            return "File is not an image.";
        }
        
        // Check file size
        if ($_FILES["file"]["size"] > 1000000) { //1mo
            return "Sorry, your file is too large.";
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        else {
            $id = $_SESSION['id'];
            $test = glob('uploads/avatar' . $id . '*');
            //Si l'utlisateur possède déjà un avatar, on le supprime car malgré la réecriture les deux fichiers peuvent avoir une extension différente
            if(!empty($test))
                unlink($test[0]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/avatar" . $id . "." . $imageFileType))
                return NULL;
            else
                return "Sorry, there was an error uploading your file.";
        }
    }

    function editProfile() {
        $message = null;

        $result = $this->getProfileInfo();

        $d = $result["Description"];
        $e = $result["Email"];
        $n = $result["Name"];
        $a = $result["Age"];
        $g = $result["Gender"];
        $o = $result["Occupation"];
        $l = $result["Location"];
        $q = $result["Quote"];

        if(isset($_POST['description']) && $_POST['description'] != $d)
            $d = htmlspecialchars($_POST['description']);

        if(isset($_POST['name']) && $_POST['name'] != $n)
            $n = htmlspecialchars($_POST['name']);

        if(isset($_POST['gender']) && $_POST['gender'] != $g)
            $g = htmlspecialchars($_POST['gender']);

        if(isset($_POST['occupation']) && $_POST['occupation'] != $o)
            $o = htmlspecialchars($_POST['occupation']);

        if(isset($_POST['location']) && $_POST['location'] != $l)
            $l = htmlspecialchars($_POST['location']);

        if(isset($_POST['quote']) && $_POST['quote'] != $q)
            $q = htmlspecialchars($_POST['quote']);

        $req = $this->connexion->prepare('UPDATE Utilisateur SET description = :description, name = :name, gender = :gender, occupation = :occupation, location = :location, quote = :quote WHERE idUser = :idsession');

        $resultat = $req->execute(array(
            ':description' => $d, 
            ':name' => $n, 
            ':gender' => $g,
            ':occupation' => $o, 
            ':location' => $l, 
            ':quote' => $q,
            ':idsession' => $_SESSION['id']));

        if(!$resultat)
            return "Sorry, something happened.";

        //On test l'adresse mail à la fin pour quand même modifier les autres champs si jamais il y a un pb avec l'adresse mail
        if(isset($_POST['email']) && $_POST['email'] != $e) {
            $e = htmlspecialchars($_POST['email']);

            $req = $this->connexion->prepare('UPDATE Utilisateur SET email = :email WHERE idUser = :idsession');

            $resultat = $req->execute(array(
                ':email' => $e, 
                ':idsession' => $_SESSION['id']));

            if(!$resultat)
                return "The email address is already taken.";
        }

        //Comme pour l'email mais avec l'age cette fois ci
        if(isset($_POST['age']) && $_POST['age'] != $a) {
            $a = (int) htmlspecialchars($_POST['age']);

            if ($a < 13 || $a > 130)
                return "Sorry, your age was incorrect !";

            $req = $this->connexion->prepare('UPDATE Utilisateur SET age = :age WHERE idUser = :idsession');

            $resultat = $req->execute(array(
                ':age' => $a, 
                ':idsession' => $_SESSION['id']));

            if(!$resultat)
                return "Sorry, something happened.";
        }
        
        if (isset($_FILES["file"]) && isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])) {
            return $this->sendFile();
        }

        return NULL;
    }
}
?>
