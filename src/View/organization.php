<?php

use Db\Connection;
use Organization\Organization;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Connection::get(),$orgahydrator);
$organizations = $orgarepository->fetchAll();

$hide = true;

if (isset($data['nameAlreadyExist']) || isset($data['nameEmpty']))
    $hide = false;

?>

<label for="choix_organisations">Liste des organisations : </label>
<input list="organisations" type="text" id="choix_organisations" name="choix_organisations">
    <datalist id="organisations">
    <?php /** @var Organization $organization */
    foreach ($organizations as $organization) { ?>
    <option value="<?php echo $organization->getName() ?>" data-value=<?php echo $organization->getId() ?>>
        <?php } ?>
</datalist>
<button id="add_orga" onclick="showform()">Ajouter une organisation</button>


<form novalidate
      method="post"
      onsubmit="return verif()"
      id="formulaire"
      action="addorupdateorganization.php"
        style="display: <?php echo $hide?'none':'block'?>">
    <div class="formulaire">
        <input type="hidden" value="" name="id" id="id">
        <div align="center">
            <label class="label-lenght-fix" for="username">Name : <em>*</em></label>
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

    document.getElementById('choix_organisations').addEventListener('input', function() {
        document.getElementById('name').value = this.value;
        document.getElementById('formulaire').style.display = "block";
        const index = [... document.getElementById('organisations').options] //*1
            .map(o => o.value) //*2
            .indexOf(this.value) //*3
        document.getElementById('id').value = document.getElementById('organisations').options[index].attributes["data-value"].value;
    });





</script>