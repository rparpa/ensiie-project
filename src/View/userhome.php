<?php

use Meeting\Meeting;
use Db\Connection;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;

$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$authenticatorService = new AuthenticatorService($userRepository);
$meetingHydrator = new MeetingHydrator();
$meetingRepository = new MeetingRepository(Connection::get(),$meetingHydrator);
$user = $authenticatorService->getCurrentUser();
$meetings = $meetingRepository->fetchByUser($authenticatorService->getCurrentUserId());

/*$meetings = $data['meetings'];
*/
require_once '../src/Bootstrap.php';
?>

<div class="project_navigation_button">
    <div style="width: 50%; float:left;">
        <form>
            <button class="button_style" type="button" >Mes projets</button>
        </form>
        <form>
            <button class="button_style" type="submit" formaction="organization.php">Organisations</button>
        </form>
    </div>
    <div style="width: 50%; float:right;">
        <form>
            <button class="button_style" type="button">Projet où je participe</button>
        </form>
        <form>
            <button class="button_style" type="button">Collaborateurs</button>
        </form>
    </div>


</div>
<br><br><br><br>
	












