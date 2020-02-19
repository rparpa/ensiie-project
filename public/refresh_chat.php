<?php
use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';

$messageHydrator = new MessageHydrator();
$messageRepository =
    new MessageRepository(Connection::get(), $messageHydrator);

$userHydrator = new UserHydrator();
$userRepository =
    new UserRepository(Connection::get(), $userHydrator);

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
