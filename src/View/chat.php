<?php

use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use User\UserRepository;

$messageHydrator = new MessageHydrator();
$messageRepository =
    new MessageRepository(Connection::get(), $messageHydrator);

$userHydrator = new \User\UserHydrator();
$userRepository =
    new UserRepository(Connection::get(), $userHydrator);


?>

<form action="chat.php" method="post">
    <p>
    <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />
    <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />

    <input type="submit" value="Envoyer" />
</p>
</form>

<table class="table">
<?php
$messages = $messageRepository->fetchAll();
foreach ($messages as $message) {
    ?>
    <tr>
        <td> <?php  echo $userRepository->findOneById($message->getIduser())->getUsername()?></td>
        <td> <?php echo $message->getMessage(); ?> </td>
    </tr>
    <?php
}
?>
</table>
