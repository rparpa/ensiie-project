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

<div class="card mx-auto" align="center" style="margin: 5em;width: 30em">
    <div class="card-header" >
        <h2>Utilisateur</h2>
    </div>
    <form class="formulaire" method="post" action="addorupdateuser.php" id="formulaire">
        <div class="card-body" >
            <input type="hidden" value="<?php echo $user?$user->getId():'' ?>" name="id">
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="text"
                       value="<?php echo $user?$user->getUsername():'' ?>"
                       name="username"
                       id="username"
                       required
                       placeholder="Username">
            </div>
            <div class="form-group">
                <?php if (isset($data['userAlreadyExist'])): ?>
                    <span id="userAlreadyExist" class="error-message"><?= $data['userAlreadyExist'] ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="text"
                       value="<?php echo $user?$user->getSurname():'' ?>"
                       name="surname"
                       id="surname"
                       required
                       placeholder="Surname">
            </div>
            <div class="form-group">
                <?php if (isset($data['surnameAlreadyExist'])): ?>
                    <span id="surnameAlreadyExist" class="error-message"><?= $data['surnameAlreadyExist'] ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="text"
                       value="<?php echo $user?$user->getName():'' ?>"
                       name="name"
                       id="name"
                       required
                       placeholder="Name">
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="email"
                       value="<?php echo $user?$user->getMail():'' ?>"
                       id="mail"
                       name="mail"
                       required
                       placeholder="Mail">
            </div>
            <div class="form-group">
                <?php if (isset($data['mailAlreadyExist'])): ?>
                    <span id="mailAlreadyExist" class="error-message"><?= $data['mailAlreadyExist'] ?></span>
                <?php endif; ?>
            </div>
            <?php if($authenticatorService->isAdministrateur()):?>
                <div class="input-group form-group" style="display: none">
                    <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                    </div>

                    <input type="checkbox"
                           checked
                           id="admin"
                           name="admin"
                           value="admin"
                           placeholder="Admin">
                </div>
            <?php endif;?>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="password"
                       value="<?php echo $user?$user->getPassword():'' ?>"
                       id="password"
                       name="password"
                       required
                       placeholder="Password">
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>
                <input type="password"
                       value="<?php echo $user?$user->getPassword():'' ?>"
                       id="passwordcheck"
                       name="passwordcheck"
                       required
                       placeholder="Password Verification">
            </div>
            <div class="form-group">
                <?php if (isset($data['passwordDoesNotMatch'])): ?>
                    <span id="passwordDoesNotMatch" class="error-message"><?= $data['passwordDoesNotMatch'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">Signup</button>
            </div>
        </div>
    </form>
</div>



<script>

    document.getElementById("username").addEventListener('keyup', function (event) {
        document.getElementById('userAlreadyExist').innerHTML = "";
    });

    document.getElementById("surname").addEventListener('keyup', function (event) {
        document.getElementById('surnameAlreadyExist').innerHTML = "";
    });

    document.getElementById("mail").addEventListener('keyup', function (event) {
        document.getElementById('mailAlreadyExist').innerHTML = "";
    });

    document.getElementById("password").addEventListener('keyup', function (event) {
        document.getElementById('passwordDoesNotMatch').innerHTML = "";
    });


</script>