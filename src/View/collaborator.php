<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;
use Service\AuthenticatorService;
use Project\Project;
use Organization\OrganizationRepository;
use Organization\OrganizationHydrator;

$userhydrator = new UserHydrator();
$authenticatorService = new AuthenticatorService($userRepository);
$organizationHydrator = new OrganizationHydrator();
$organizationRepository = new OrganizationRepository(Connection::get(), $organizationHydrator);

$org = ((object) $organizationRepository->fetchByUser($authenticatorService->getCurrentUserId()))->organization;
//TODO Faire bien mieux mais la je fatigue un peu

?>
<h1>
    Collaborateurs de l'organisation <?php echo $org->getName() ?>
</h1>


<div class="container" style="margin-top: 5em">
    <div>
        <h5>Collaborateurs</h5>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date d'inscription</th>
                </tr>
            </thead>
            <tbody id="tableusers">
                <?php include_once 'select_usersinorga.php' ?>
            </tbody>
        </table>
    </div>
    <select id="select-user-add">
        <?php include_once 'select_usersnotinorga.php' ?>
    </select>
    <button id="button-user-add">Ajouter</button>
</div>

<script>
    function ShowAlert() {
        alert("Un truc cool a faire je pense!!")
    }

    document.getElementById("button-user-add").addEventListener('click', function () {
        var index = $("#select-user-add").prop("selectedIndex");
        if(index>=0){
            var iduser = $("#select-user-add").find(':selected').attr('data-id');
            //TODO ajouter une saisie lors de la selection
            var role = "Larbin";
            $.get({
                url: 'addusertoorga.php',
                data: {
                    iduser:iduser,
                    role:role,
                    idorganization:<?php echo $org->getId(); ?>
                },success:refreshuser
            });
        }
    });


    function refreshuser() {
        $('#select-user-add').load('select_usersnotinorga.php');
        $('#tableusers').load('select_usersinorga.php');
    }
</script>