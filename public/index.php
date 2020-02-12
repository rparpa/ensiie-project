<?php

require_once '../src/Bootstrap.php';

$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository(\Db\Connection::get(), $userHydrator);
$users = $userRepository->fetchAll();
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
            <td>UserName</td>
            <td>SurName</td>
            <td>Name</td>
            <td>Mail</td>
            <td>Password</td>
            <td>Date de Creation</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getUsername() ?></td>
                <td><?php echo $user->getSurname() ?></td>
                <td><?php echo $user->getName() ?></td>
                <td><?php echo $user->getMail() ?></td>
                <td><?php echo $user->getPassword() ?></td>
                <td><?php echo $user->getCreationdate()->format("Y-m-d H:i:s") ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
