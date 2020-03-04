<?php

class ModelePassword extends ModeleGenerique {
    
    function changePassword () {
        if (empty($_POST["oldPassword"]) || empty($_POST["newPassword"]) || empty($_POST["newPasswordRepeat"])) {
            return 'Please enter the passwords';
        } else {
            $oldPassword = hash('sha512', htmlspecialchars($_POST["oldPassword"]));
            $newPassword = hash('sha512', htmlspecialchars($_POST["newPassword"]));
            $newPasswordRepeat = hash('sha512', htmlspecialchars($_POST["newPasswordRepeat"]));
        }

        $req = $this->connexion->prepare('SELECT password FROM Utilisateur WHERE pseudo = ?');
        $req->execute(array($_SESSION['pseudo']));
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($oldPassword != $result['password'])
            return "Your old password isn't correct !";
        else {
            if ($newPassword != $newPasswordRepeat)
                return 'The two passwords do not match !';
            else {
                $new_private_key_string = '';
                $private_key = openssl_pkey_get_private($_SESSION['private_key']);
                openssl_pkey_export($private_key, $new_private_key_string, $_POST["newPassword"]);
                $req = $this->connexion->prepare("UPDATE Utilisateur SET password = :password, private_key = :private_key WHERE pseudo = :pseudo");
                $stmt = $req->execute(array(
                    'pseudo' => $_SESSION['pseudo'],
                    'password' => $newPassword,
                    'private_key' => $new_private_key_string));

                if (!$stmt)
                    return 'Something went wrong !';
            }
        }
        return NULL;
    }
}

?>
