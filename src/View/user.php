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
    <div class="formulaire">
        <div align="center">
            <legend>Utilisateur </legend>
        </div>
        <input type="hidden" value="<?php echo $user?$user->getId():'' ?>" name="id">
        <div align="center">
            <label class="label-lenght-fix" for="username">Username : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getUsername():'' ?>"
                   name="username"
                   id="username"
                   required=""><br>
            <span class="error" aria-live="polite" id="errorusername"></span>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="surname">Surname : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getSurname():'' ?>"
                   name="surname"
                   id="surname"><br>
            <span class="error" aria-live="polite" id="errorsurname"></span>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getName():'' ?>"
                   name="name"
                   id="name"><br>
            <span class="error" aria-live="polite" id="errorname"></span>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="mail">Mail : <em>*</em></label>
            <input type="email"
                   value="<?php echo $user?$user->getMail():'' ?>"
                   id="mail"
                   name="mail"><br>
            <span class="error" aria-live="polite" id="errormail"></span>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="password">Password : <em>*</em></label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="password"
                   name="password"><br>
            <span class="error" aria-live="polite" id="errorpassword"></span>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="passwordcheck">Password Verification : <em>*</em> </label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="passwordcheck"
                   name="passwordcheck"><br>
            <span class="error" aria-live="polite" id="errorpasswordcheck"></span>
        </div>
        <div align="center">
            <p><button>Envoyer</button>
        </div>

    </div>
</form>


<script>
    function verif() {
        var email = document.getElementById('mail');
        var username = document.getElementById('username');
        var name = document.getElementById('name');
        var surname = document.getElementById('surname');
        var password = document.getElementById('password');

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
            document.getElementById('errorname').innerHTML = "Le prénom d'utilisateur n'est pas valide";
            valide &= false;
        }
        else{
            document.getElementById('errorname').innerHTML = ""; // On réinitialise le contenu
        }
        if (surname.value==='') {
            document.getElementById('errorsurname').innerHTML = "Le nom d'utilisateur n'est pas valide";
            valide &= false;
        }
        else{
            document.getElementById('errorsurname').innerHTML = ""; // On réinitialise le contenu
        }
        if (password.value==='') {
            document.getElementById('errorpassword').innerHTML = "Le mot de passe n'est pas valide";
            valide &= false;
        }
        else{
            document.getElementById('errorpassword').innerHTML = ""; // On réinitialise le contenu
        }


        return valide==1;
    }
</script>


