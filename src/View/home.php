<?php

use User\User;

$users = $data["users"];
?>

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
    <?php /** @var User $user */
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