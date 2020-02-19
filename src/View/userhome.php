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
		<button class="button_style" type="button">Mes projets</button>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button class="button_style" type="button">Organisations</button>
		<br>
		<button class="button_style" type="button">Projet où je participe</button>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button class="button_style" type="button">Collaborateurs</button>
	</div>
	<br><br><br><br>
	












