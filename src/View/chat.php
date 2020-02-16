<?php

use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use User\UserHydrator;
use User\UserRepository;

$messageHydrator = new MessageHydrator();
$messageRepository =
    new MessageRepository(Connection::get(), $messageHydrator);

$userHydrator = new UserHydrator();
$userRepository =
    new UserRepository(Connection::get(), $userHydrator);

?>

<form action="chat.php" method="post">
    <?php if ($authenticatorService->isAuthenticated()) {?>
    <p>
        <input type="hidden" value=<?php echo $authenticatorService->getCurrentUser()->getUsername()?> name="pseudo"/>
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
        <input type="submit" value="Envoyer" />
    </p>
    <?php } ?>
</form>

<table class="table">
<?php
$messages = $messageRepository->fetchAll();
foreach (array_reverse($messages) as $message) {
    ?>
    <tr>
        <td> <?php  echo $userRepository->findOneById($message->getIduser())->getUsername()?></td>
        <td> <?php echo $message->getMessage(); ?> </td>
    </tr>
    <?php
}
?>
</table>
