<?php

use Db\Connection;
use Service\AuthenticatorService;
use User\User;
use User\UserHydrator;
use User\UserRepository;

if (isset($data['user'])) {
    /** @var User $user */
    $user = $data["user"];
}
else{
    $user=null;
}

$userRepository = new UserRepository(Connection::get(), new UserHydrator());
$authenticatorService = new AuthenticatorService($userRepository);

?>

<form class="formulaire" method="post" action="addorupdateuser.php">
    <div class="container-fluid" >
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
                   required>
            <span class="error" aria-live="polite" id="errorusername"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="surname">Surname : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getSurname():'' ?>"
                   name="surname"
                   id="surname" required><br>
            <span class="error" aria-live="polite" id="errorsurname"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
            <input type="text"
                   value="<?php echo $user?$user->getName():'' ?>"
                   name="name"
                   id="name" required><br>
            <span class="error" aria-live="polite" id="errorname"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="mail">Mail : <em>*</em></label>
            <input type="email"
                   value="<?php echo $user?$user->getMail():'' ?>"
                   id="mail"
                   name="mail" required><br>
            <span class="error" aria-live="polite" id="errormail"></span>
        </div>
        <?php if($authenticatorService->isAdministrateur()):?>
        <div class="form-row">
            <label class="label-lenght-fix" for="admin">Admin : <em>*</em></label>
            <input type="checkbox"
                   checked
                   id="admin"
                   name="admin"
                   value="admin"><br>
        </div>
        <?php endif;?>
        <div class="form-row">
            <label class="label-lenght-fix" for="password">Password : <em>*</em></label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="password"
                   name="password" required><br>
            <span class="error" aria-live="polite" id="errorpassword"></span>
        </div>
        <div class="form-row">
            <label class="label-lenght-fix" for="passwordcheck">Password Verification : <em>*</em> </label>
            <input type="password"
                   value="<?php echo $user?$user->getPassword():'' ?>"
                   id="passwordcheck"
                   name="passwordcheck" required><br>
            <span class="error" aria-live="polite" id="errorpasswordcheck"></span>
        </div>
        <div class="form-row">
            <button>Envoyer</button>
        </div>
    </div>
</form>
