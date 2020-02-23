<?php

use Db\Connection;
use Organization\Organization;
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


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <label for="choix_project">Liste des organisations : </label>
            <select id="select-projets">
                <option></option>
                <?php /** @var Project $project */
                foreach ($projects as $project) { ?>
                    <option value="<?php echo $project->getName() ?>"
                            data-value=<?php echo $project->getId() ?>
                            data-idorga=<? echo $project->getIdorganization()?>
                            data-nameorga="<? echo $orgarepository->findOneById($project->getIdorganization())->getName()?>" > <?php echo $project->getName() ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col">
            <button id="add_project" onclick="showform()">Ajouter un projet</button>
        </div>
    </div>
    <div class="row">
        <form class="formulaire" method="post" onsubmit="return verif()" id="formulaire" action="addorupdateproject.php" style="display: <?php echo $hide?'none':'block'?>">
            <input type="hidden" value="" name="id" id="id">
            <div class="container-fluid">
                <div class="form-row" align="center">
                    <legend>Projet </legend>
                </div>
                <div class="form-row">
                    <label class="label-lenght-fix" for="name">Name : <em>*</em></label>
                    <input type="text" value="" name="name" id="name" required="">
                    <span class="error" aria-live="polite" id="errorname"></span>
                </div>
                <div class="form-row">
                    <?php if (isset($data['nameAlreadyExist'])): ?>
                        <span class="error-message" ><?= $data['nameAlreadyExist'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <?php if (isset($data['nameEmpty'])): ?>
                        <span class="error-message"><?= $data['nameEmpty'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <input type="hidden" id="idorganization" name="idorganization" value="">
                    <label class="label-lenght-fix" for="idorganisations">Organisation : <em>*</em></label>
                    <select id="select-organizations">
                        <option></option>
                        <?php /** @var Organization $organization */
                        foreach ($organizations as $organization) { ?>
                            <option value="<?php echo $organization->getName() ?>" data-value=<?php echo $organization->getId() ?>><?php echo $organization->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <button>Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>


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
        document.getElementById('id').value = "";
        document.getElementById('name').value = "";
        document.getElementById('idorganization').value = "";
        document.getElementById('select-organizations').value = "";
        document.getElementById('formulaire').style.display = "block";
    };


    var select = document.getElementById('select-projets');
    select.addEventListener('change', function () {
        var index = select.selectedIndex;
        if (index<1)
        {
            document.getElementById('id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('select-organizations').value = "";
            document.getElementById('idorganization').value = '';
            document.getElementById('formulaire').style.display = "none";
        }
        else {
            document.getElementById('id').value = select.options[index].attributes["data-value"].value;
            document.getElementById('idorganization').value = select.options[index].attributes["data-idorga"].value;
            document.getElementById('name').value = this.value;
            document.getElementById('select-organizations').value = select.options[index].attributes["data-nameorga"].value;
            document.getElementById('formulaire').style.display = "block";
        }
    })

    var select_orga = document.getElementById('select-organizations');
    select_orga.addEventListener('change', function () {
        var index = select_orga.selectedIndex;
        if (index<1)
        {
            document.getElementById('idorganization').value = '';
        }
        else
        {
            document.getElementById('idorganization').value = select_orga.options[index].attributes["data-value"].value;
        }
    })


</script>