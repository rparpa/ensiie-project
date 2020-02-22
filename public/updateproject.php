<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\ProjectHydrator;
use Project\ProjectRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projecthydrator =
    new ProjectHydrator();
$projectrepository =
    new ProjectRepository(Connection::get(), $projecthydrator);

$orgahydrator =
    new OrganizationHydrator();
$orgarepository =
    new OrganizationRepository(Connection::get(), $orgahydrator);

$id =  !empty($_POST['id']) ? $_POST['id'] : null;
$name =  !empty($_POST['name']) ? $_POST['name'] : null;
$idorganization =  !empty($_POST['idorganization']) ? $_POST['idorganization'] : null;

$orga = $orgarepository->findOneById($idorganization);
?>

<form novalidate
      method="post"
      onsubmit="return verif()"
      id="formulaire"
      action="addorupdateproject.php"
    <div class="formulaire" style="margin: 1em 1em 1em; border: none">
        <input type="hidden" value="<? echo $id??'' ?>" name="id" id="id">
        <div align="center">
            <legend>Projet </legend>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
            <input type="text"
                   value="<? echo $name??'' ?>"
                   name="name"
                   id="name"
                   required=""><br>
            <span class="error" aria-live="polite" id="errorname"></span>
            <?php if (isset($data['nameAlreadyExist'])): ?>
                <span class="error-message" ><?= $data['nameAlreadyExist'] ?></span>
            <?php endif; ?>
            <?php if (isset($data['nameEmpty'])): ?>
                <span class="error-message"><?= $data['nameEmpty'] ?></span>
            <?php endif; ?>
        </div>
        <div align="center">
            <input type="hidden" id="idorganization" name="idorganization" value="<? echo $idorganization??'' ?>">
            <label class="label-lenght-fix" for="idorganisations">Organisation : <em>*</em></label>
            <input list="organisations" type="text" id="choix_organisations" name="choix_organisations" value="<? echo $orga->getName()?>">
        </div>
        <div align="center">
            <p><button>Envoyer</button>
        </div>
    </div>
</form>