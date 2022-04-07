<?php

use Db\Connection;
use User\UserRepository;

require_once '../src/Bootstrap.php';

$userRepository = new UserRepository(Connection::get());
$users = $userRepository->fetchAll();
?>

<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/main.css">
    <script src="static/js/display-nav.js"></script>
</head>
<body>
<?php
include "../src/templates/structure.php";
?>
<main>
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>#</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Age</td>
        </thead>
        <tbody>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
                <td><?php echo $user->getAge() ?> years</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
