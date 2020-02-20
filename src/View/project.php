<?php

use Db\Connection;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;
use Project\Project;
use Project\ProjectHydrator;
use Project\ProjectRepository;

$projecthydrator = new ProjectHydrator();
$projectrepository = new ProjectRepository(Connection::get(),$projecthydrator);
$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Db\Connection::get(),$orgahydrator);
$projects = $projectrepository->fetchAll();
$organizations = $orgarepository->fetchAll();

$hide = true;

if (isset($data['nameAlreadyExist']) || isset($data['nameEmpty']))
    $hide = false;

?>

<label for="choix_project">Liste des projets : </label>
<input list="projects" type="text" id="choix_project" name="choix_project">
    <datalist id="projects">
    <?php /** @var Project $project */
    foreach ($projects as $project) { ?>
    <option value="<?php echo $project->getName() ?>"
            data-value="<?php echo $project->getId()  ?>"
            data-idorga="<?php echo $project->getIdorganization() ?>">
        <?php } ?>
</datalist>
<button id="add_project" onclick="showform()">Ajouter un projet</button>


<form novalidate
      method="post"
      onsubmit="return verif()"
      id="formulaire"
      action="addorupdateproject.php"
        style="display: <?php echo $hide?'none':'block'?>">
    <div class="formulaire">
        <input type="hidden" value="" name="id" id="id">
        <div align="center">
            <legend>Projet </legend>
        </div>
        <div align="center">
            <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
            <input type="text"
                   value=""
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
            <input type="hidden" id="idorganization" name="idorganization" value="">
            <label class="label-lenght-fix" for="idorganisations">Organisation : <em>*</em></label>
            <input list="organisations" type="text" id="choix_organisations" name="choix_organisations" value="">
            <datalist id="organisations">
                <?php /** @var Organization $organization */
                foreach ($organizations as $organization) { ?>
                <option value="<?php echo $organization->getName() ?>"
                        data-value="<?php echo $organization->getId() ?>">
                    <?php } ?>
            </datalist>
        </div>
        <div align="center">
            <p><button>Envoyer</button>
        </div>
    </div>
</form>


<script>
    function verif() {
        var valide = true;
        var name = document.getElementById('name');

        if (name.value==='') {
            document.getElementById('errorname').innerHTML = "Le nom n'est pas renseigné !";
            valide &= false;
        }
        else{
            document.getElementById('errorname').innerHTML = ""; // On réinitialise le contenu
        }
        return valide==1;
    }

    function showform() {
        document.getElementById('formulaire').style.display = "block";
    };

    document.getElementById('choix_project').addEventListener('input', function() {
        document.getElementById('name').value = this.value;
        document.getElementById('formulaire').style.display = "block";
        var index = [... document.getElementById('projects').options] //*1
            .map(o => o.value) //*2
            .indexOf(this.value) //*3
        document.getElementById('id').value = document.getElementById('projects').options[index].attributes["data-value"].value;
        document.getElementById('idorganization').value = document.getElementById('projects').options[index].attributes["data-idorga"].value;

        index = [... document.getElementById('organisations').options] //*1
            .map(o => o.attributes[1].value) //*2
            .indexOf(document.getElementById('idorganization').value) //*3
        document.getElementById('choix_organisations').value = document.getElementById('organisations').options[index].value;
    });

    document.getElementById('choix_organisations').addEventListener('input', function() {
        const index = [... document.getElementById('organisations').options] //*1
            .map(o => o.value) //*2
            .indexOf(this.value) //*3
        document.getElementById('idorganization').value = document.getElementById('organisations').options[index].attributes["data-value"].value;
    });

</script>