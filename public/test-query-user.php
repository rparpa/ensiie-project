<?php

require_once '../src/Bootstrap.php';

$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $newUser = new \User\User();
    $newUser->setFirstname($_POST["firstname"]);
    $newUser->setLastname($_POST["lastname"]);
    $newUser->setBirthday(new DateTimeImmutable($_POST["birthday"]));
    $newUser->setPseudo($_POST["pseudo"]);
    $newUser->setMail($_POST["mail"]);
    $newUser->setPassword($_POST["password"]);
    $newUser->setIsValidator(false);

    $userService->createUser($newUser);
}

$users = $userService->getAllUser();
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>#</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Age</td>
        <td>Pseudo</td>
        <td>e-mail</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
                <td><?php echo $user->getAge() ?> years</td>
                <td><?php echo $user->getPseudo() ?></td>
                <td><?php echo $user->getMail() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="" method="POST">
        <label for="firstname">Prénom 🎫 :</label><br>
        <input type="text" id="firstname" name="firstname"><br>

        <label for="lastname">Nom 🎫 :</label><br>
        <input type="text" id="lastname" name="lastname"><br>

        <label for="birthday">Date de naissance 📅 :</label><br>
        <input type="date" id="birthday" name="birthday" value="2010-01-01"><br>

        <label for="pseudo">Pseudo 💳 :</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>

        <label for="mail">Adresse mail ✉️ :</label><br>
        <input type="text" id="mail" name="mail"><br>

        <label for="password">Mot de passe 🔐 :</label><br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Créer un compte"><br>
    </form>
    <h3>Login</h3>
    <form class = "form-signin" action="test-login.php" method="POST">
        <label for="pseudo">Pseudo 💳 :</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>

        <label for="password">Mot de passe 🔐 :</label><br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Se connecter"><br>
    </form>

    <?php
    $testUser = new \User\User();
    $testUser->setFirstname("toto");
    $testUser->setLastname("tata");
    $testUser->setPassword("thisisatest");
    $testUser->setPseudo("test_User");
    $testUser->setMail("test@test.net");
    $testUser->setBirthday(new DateTimeImmutable("1990-01-01"));
    $userService->createUser($testUser);
    $testUser = $userService->getUser("test_User", "thisisatest");
    $userService->getUserById($testUser->getId());
    $userService->deleteUser($testUser);
    ?>

</div>
</body>
</html>
