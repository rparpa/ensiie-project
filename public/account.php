<?php include('../src/View/header.php') ?>


<?php if(!isset($_SESSION["user_login"])){
        header('Location: pokedex.php');
      }
      //var_dump($_SESSION["user_login"]);die;

?>
<div class="container">

    <div id="printresult">
      <h3>Vos Favoris</h3>
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
    "ajax": {
      "url": "ApplicationController.php",
      data: function (d) {
        d.id_user = "<?php echo $_SESSION["user_login"];?>";
        d.action = "searchFav";
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
