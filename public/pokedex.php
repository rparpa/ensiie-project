<?php include('../src/View/header.php') ?>

<div class="container">

  <div class="row">
    <h1><b>Recherche</b></h1>
  </div>

  <form method="post" id="search">
    <div class="row">
      <div class="col-md-12">
        <label for="login"><b>Nom du pokemon :</b></label>
        <input type="text" name="name" id="name">
        <label for="type1"><b>Type 1:</b></label>
        <select name="type1" id="type1" class="browser-default custom-select">
          <option value=""></option>
          <option value="grass">Plante</option>
          <option value="poison">Poison</option>
          <option value="dragon">Dragon</option>
          <option value="dark">Ténébre</option>
          <option value="bug">Insecte</option>
          <option value="electric">Electrique</option>
          <option value="fairy">Fée</option>
          <option value="fighting">Combat</option>
          <option value="fire">Feu</option>
          <option value="flying">Vol</option>
          <option value="ghost">Spectre</option>
          <option value="ground">Sol</option>
          <option value="ice">Glace</option>
          <option value="normal">Normal</option>
          <option value="psychic">Psy</option>
          <option value="rock">Roche</option>
          <option value="steel">Acier</option>
          <option value="water">Eau</option>
        </select>
        <br><br>
        <label for="type2"><b>Type 2:</b></label>
        <select name="type2" id="type2" class="browser-default custom-select">
          <option value=""></option>
          <option value="grass">Plante</option>
          <option value="poison">Poison</option>
          <option value="dragon">Dragon</option>
          <option value="dark">Ténébre</option>
          <option value="bug">Insecte</option>
          <option value="electric">Electrique</option>
          <option value="fairy">Fée</option>
          <option value="fighting">Combat</option>
          <option value="fire">Feu</option>
          <option value="flying">Vol</option>
          <option value="ghost">Spectre</option>
          <option value="ground">Sol</option>
          <option value="ice">Glace</option>
          <option value="normal">Normal</option>
          <option value="psychic">Psy</option>
          <option value="rock">Roche</option>
          <option value="steel">Acier</option>
          <option value="water">Eau</option>
        </select>
        <br><br>
        <label for="type1"><b>Légendaire:</b></label>
        <input type="checkbox" id="is_legendary" name="is_legendary">
        <br><br>
      </div>
    </div>
    <div class="row">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
    </div>


  </form>

  <div id="printresult">
    <h3>Résultat de la recherche</h3>
    <table class="table table-striped table-sm table-bordered table-hover" id="table-print">
      <thead>
        <tr>
          <th data-name="pokedex_number">#</th>
          <th data-name="french_name">Nom Pokemon</th>
          <th data-name="type1">Type</th>
          <th data-name="type2">Type</th>
        </tr>
      </thead>
    </table>
  </div>

</div>

<?php include('../src/View/footer.php') ?>

<script type="text/javascript">

$(document).ready(function () {
  var dt = $("#table-print").DataTable({
    "processing": true,
    "serverSide": true,
    "bFilter": false,
    "ajax": {
      "url": "ApplicationController.php",
      data: function (d) {
        d.name = $("#name").val();
        d.type1 = $("#type1").val();
        d.type2 = $("#type2").val();
        d.action = "search";
        d.legendary = document.getElementById("is_legendary").checked;
        return d;
      },
      "type": "POST"
    },
    "columns": [
      {"data": "pokedex_number"},
      {"data": "french_name"},
      {"data": "type1"},
      {"data": "type2"}
    ],
    "lengthMenu": [[ -1], [ "Tous"]],
    "pageLength": -1
  });

  $("#search").on("submit", function () {
    dt.ajax.reload(null, false);
    return false;
  });
});
</script>
