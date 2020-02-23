<?php
use Db\Connection;
use Message\MessageHydrator;
use Message\MessageRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;


require_once '../src/Bootstrap.php';

$messageRepository =
    new MessageRepository(Connection::get(), new MessageHydrator());

$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$authenticatorService = new AuthenticatorService($userRepository);

$orgarepository =
    new OrganizationRepository(Connection::get(), new OrganizationHydrator());

//TODO changer pour ajouter la gestion des sources
$source = new Chat();

if($authenticatorService->isAuthenticated()){
    $userorga = $orgarepository->fetchByUser($authenticatorService->getCurrentUserId());
    if($userorga)
        $source = ((Object)$userorga)->organization;
}


$messages = $messageRepository->fetchAllForChat($source);

foreach ($messages as $message) {
    ?>
    <tr>
        <td> <?php  echo $userRepository->findOneById($message->getIduser())->getUsername()?></td>
        <td> <?php echo $message->getMessage(); ?> </td>
    </tr>
    <?php
}
?>
