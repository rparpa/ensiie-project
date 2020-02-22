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

<form class="formulaire" method="post" action="addorupdateuser.php">
    <div class="container-fluid">
        <div class="form-row" align="center">
            <legend>Utilisateur</legend>
        </div>
        <input type="hidden" value="<?php echo $user?$user->getId():'' ?>" name="id">
        <div class="form-row">
            <label class="label-lenght-fix" for="username">Username : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getUsername():'' ?>"
                   name="username"
                   id="username"
                   required="">
            <span class="error" aria-live="polite" id="errorusername"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="surname">Surname : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getSurname():'' ?>"
                   name="surname"
                   id="surname"><br>
            <span class="error" aria-live="polite" id="errorsurname"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getName():'' ?>"
                   name="name"
                   id="name"><br>
            <span class="error" aria-live="polite" id="errorname"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="mail">Mail : <em>*</em></label>
            <input type="email"
                   value="<?php echo $user?$user->getMail():'' ?>"
                   id="mail"
                   name="mail"><br>
            <span class="error" aria-live="polite" id="errormail"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="password">Password : <em>*</em></label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="password"
                   name="password"><br>
            <span class="error" aria-live="polite" id="errorpassword"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="passwordcheck">Password Verification : <em>*</em> </label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="passwordcheck"
                   name="passwordcheck"><br>
            <span class="error" aria-live="polite" id="errorpasswordcheck"></span>
        </div>
        <div class="form-row">
            <button>Envoyer</button>
        </div>
    </div>
</form>
