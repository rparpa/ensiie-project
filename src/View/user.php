<?php

use User\User;

if (isset($data['user'])) {
    /** @var User $user */
    $user = $data["user"];
}
else{
    $user=null;
}

?>

<form novalidate method="post" onsubmit="return verif()" action="addorupdateuser.php">
    <input type="hidden" value="<?php echo $user?$user->getId():'' ?>" name="id">
    <p>
        <label for="username">
            <span>Username :</span>
            <input type="text" value="<?php echo $user?$user->getUsername():'' ?>" name="username" id="username">
            <span class="error" aria-live="polite" id="errorusername"></span>
        </label>
    <p>
    <p>
        <label for="surname">
            <span>Surname :</span>
            <input type="text" value="<?php echo $user?$user->getSurname():'' ?>" name="surname" id="surname">
            <span class="error" aria-live="polite" id="errorsurname"></span>
        </label>
    <p>
    <p>
        <label for="name">
            <span>Name :</span>
            <input type="text" value="<?php echo $user?$user->getName():'' ?>" name="name" id="name">
            <span class="error" aria-live="polite" id="errorname"></span>
        </label>
    <p>
    <p>
        <label for="mail">
            <span>Mail :</span>
            <input type="email" value="<?php echo $user?$user->getMail():'' ?>" id="mail" name="mail">
            <span class="error" aria-live="polite" id="errormail"></span>
        </label>
    <p>
    <p>
        <label for="password">
            <span>Password :</span>
            <input type="password" value="<?php echo $user?$user->getPassword():'' ?>" id="password" name="password">
            <span class="error" aria-live="polite" id="errorpassword"></span>
        </label>
    <p>
    <p>
        <label for="passwordcheck">
            <span>Password Verification :</span>
            <input type="password" value="<?php echo $user?$user->getPassword():'' ?>" id="passwordcheck" name="passwordcheck">
            <span class="error" aria-live="polite" id="errorpasswordcheck"></span>
        </label>
    <p>
        <button>Envoyer</button>
</form>









<script>
    function verif() {
        var email = document.getElementById('mail');
        var username = document.getElementById('username');
        var name = document.getElementById('name');

        var valide = true;
        if (!email.validity.valid || email.value === '') {
            document.getElementById('errormail').innerHTML = "J'attends une adresse e-mail correcte";
            valide &= false;
        } else {
            document.getElementById('errormail').innerHTML = ""; // On réinitialise le contenu
        }
        if (username.value==='') {
            document.getElementById('errorusername').innerHTML = "Le pseudo d'utilisateur n'est pas valide";
            valide &= false;
        }
        else{
            document.getElementById('errorusername').innerHTML = ""; // On réinitialise le contenu
        }
        if (name.value==='') {
            document.getElementById('errorname').innerHTML = "Le nom d'utilisateur n'est pas valide";
            valide &= false;
        }
        else{
            document.getElementById('errorname').innerHTML = ""; // On réinitialise le contenu
        }
        return valide==1;
    }
</script>


