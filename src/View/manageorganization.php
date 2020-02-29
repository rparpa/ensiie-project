<?php

use Db\Connection;
use Organization\Organization;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

$orgarepository = new OrganizationRepository(Connection::get(),new OrganizationHydrator());
$organizations = $orgarepository->fetchAll();

$hide = true;

if (isset($data['nameAlreadyExist']) || isset($data['nameEmpty']))
    $hide = false;

?>

<div class="container-fluid">
    <div align="center" class="row">
        <div class="col">
            <label for="choix_organisations">Liste des organisations : </label>
            <select id="select-organizations">
                <option></option>
                <?php /** @var Organization $organization */
                foreach ($organizations as $organization) { ?>
                    <option value="<?php echo $organization->getName() ?>" data-value=<?php echo $organization->getId() ?>><?php echo $organization->getName() ?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="col">
            <button id="add_orga" onclick="showform()">Ajouter une organisation</button>
        </div>
    </div>
    <div class="row">
        <form class="formulaire" id="formulaire" action="addorupdateorganization.php" method="post" style="display: <?php echo $hide?'none':'block'?>">
            <input type="hidden" value="" name="id" id="id">
            <div class="container-fluid">
                <div class="form-row" align="center">
                    <legend>Organisation </legend>
                </div>
                <div class="form-row">
                    <label class="label-lenght-fix" for="username">Name : <em>*</em></label>
                    <input type="text"
                           value=""
                           name="name"
                           id="name"
                           required="">
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
        document.getElementById('name').value = "";
        document.getElementById('id').value = "";
        document.getElementById('formulaire').style.display = "block";
    };

    var select = document.getElementById('select-organizations');
    select.addEventListener('change', function () {
        var index = select.selectedIndex
        if (index<1)
        {
            document.getElementById('id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('formulaire').style.display = "none";
        }
        else {
            document.getElementById('id').value = select.options[index].attributes["data-value"].value;
            document.getElementById('name').value = this.value;
            document.getElementById('formulaire').style.display = "block";
        }
    })



</script>