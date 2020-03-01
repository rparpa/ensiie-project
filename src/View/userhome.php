<?php

use Meeting\Meeting;
use Db\Connection;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;
use Meeting\MeetingHydrator;
use Meeting\MeetingRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;


$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$authenticatorService = new AuthenticatorService($userRepository);
$meetingHydrator = new MeetingHydrator();
$meetingRepository = new MeetingRepository(Connection::get(), $meetingHydrator);
$organizationHydrator = new OrganizationHydrator();
$organizationRepository = new organizationRepository(Connection::get(), $organizationHydrator);
$user = $authenticatorService->getCurrentUser();
$meetings = $meetingRepository->fetchByUser($authenticatorService->getCurrentUserId());

require_once '../src/Bootstrap.php';
?>
<div style="margin: 5em">
    <?php if (!$authenticatorService->isAdministrateur()) : ?>
        <?php
        $org = $organizationRepository->fetchByUser($authenticatorService->getCurrentUserId());
        if ($org != null) {
            ?>

            <div class="row">
                <div class="col" style="padding: 1em;" align="center">
                    <form>
                        <button class="button_style" type="submit" formaction="chefproject.php">Mes projets</button>
                    </form>
                </div>
                <div class="col" align="center" style="padding: 1em;">
                    <form>
                        <button class="button_style" type="submit" formaction="myorganization.php">Mon organisation</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col" align="center" style="padding: 1em;">
                    <form>
                        <button class="button_style" type="submit" formaction="myprojects.php">Projets où je participe</button>
                    </form>
                </div>
                <div class="col" align="center" style="padding: 1em;">
                    <form>
                        <button class="button_style" type="submit" formaction="collaborator.php">Collaborateurs</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="container-fluid" style="padding: 20em">
                <div class="row">
                    <div class="col">
                        <h2 align="center">Vous n'avez pas d'organisation, contactez un administrateur.</h2>
                    </div>
                </div>
            </div>
            <?php
        }
    endif; ?>
</div>
