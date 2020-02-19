<?php

use Organization\Organization;

$organizations = $data["organizations"];
?>

<label for="choix_organisations">Liste des organisations : </label>
<input list="organisations" type="text" id="choix_organisations" name="choix_organisations">
<datalist id=organisations >
    <?php /** @var Organization $organization */
    foreach ($organizations as $organization) { ?>
    <option> <?php echo $organization->getName()  ?>
        <?php } ?>
</datalist>


<script>
    document.getElementById('choix_organisations').addEventListener('input', function() {
        document.getElementById('name').value = this.value;
    });

</script>

<form novalidate method="post" onsubmit="return verif()" action="addorupdateorganization.php">
    <input type="hidden" value="" name="id">
    <div align="center">
        <label class="label-lenght-fix" for="username">Name : <em>*</em></label>
        <input type="text"
               value=""
               name="name"
               id="name"
               required=""><br>
        <span class="error" aria-live="polite" id="errorname"></span>
    </div>
    <div align="center">
        <p><button>Envoyer</button>
    </div>
</form>