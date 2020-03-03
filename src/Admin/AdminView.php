<?php
namespace Admin;
use PDO;

class AdminView {
  public function __construct() {
  }

  public function afficheLocations($locations) {
    ?> <link href="adminpanel.css" rel="stylesheet" type="text/css" media="screen" />
    <div id="logo" class="container">
    <h1><a href="#">Admin Panel</a></h1>
    </div>
    <div id="page" class="container">
      <div class="entry">
        <h2 style="text-align: center">Liste des locations en cours</h2>
          <p style="text-align: center">Résumer des locations actuellement en cours, possibilité d'annuler la location.</p>
      </div>
    </div>
    <?php
    $i = 0;
    foreach($locations as $location) {
      if($i % 3 == 0) {
        ?><div id="three-column-loc" class="container"><?php
      }?>
      <div class="tbox<?php echo $i+1; ?>">
        <div class="box-style box-style0<?php echo $i+1; ?>">
          <div class="content">
            <h2><?php echo $location->getVoitureImmat(); ?></h2>
            <p><?php echo $location->getUserEmail() . " " . $location->getKmMax() . "km max"; ?></p>
            <p><?php echo $location->getDateDebut() . " " . $location->getDateFin() . " "; ?></p>
            <a href="index.php?action=deleteLocation&location_id=<?php echo $location->getId();?>" class="button">Supprimer</a>  
          </div>
        </div>
      </div>
      <?php
      $i++;
      if($i % 3 == 0) {
      ?></div><?php
      }
    }
  }

  public function afficheVoitures($voitures) {
  ?>
  <div id="carpool-header" class="container">
  <div>
    <div class="entry">
      <h2 style="text-align: center"> CAR LIST - Gestion du parc automobile</h2>
      <p style="text-align: center"> Ci-dessous la preview de chaque voiture avec un bouton pour les modifier ou supprimer. </p>
      <div id="addcar" class="container">
        <a href="index.php?action=ajouter" class="button">Ajouter une voiture</a>
      </div>
    </div>
  </div>
  </div>
  <?php
  $i = 0;
  foreach($voitures as $voiture) {
    if($i % 3 == 0) {
      ?><div id="three-column" class="container"><?php
    }?>
    <div class="tbox<?php echo $i+1; ?>">
      <div class="box-style box-style0<?php echo $i+1; ?>">
        <div class="content">
          <div class="image"><a href="#"><img src="<?php echo $voiture->getImage(); ?>" width="324" height="200" alt="" /></a></div>
            <h2><?php echo $voiture->getMarque() . " " . $voiture->getModele(); ?></h2>
            <p><?php echo $voiture->getFinition() . " " . $voiture->getPuissance() . "ch"; ?></p>
            <a href="index.php?action=modifVoiture&car_id=<?php echo $voiture->getId();?>" class="button">Modifier</a>
            <a href="index.php?action=deleteVoiture&car_id=<?php echo $voiture->getId();?>" class="button">Supprimer</a>  
          </div>
        </div>
      </div>
      <?php
      $i++;
      if($i % 3 == 0) {
        ?></div><?php
      }
    }
  }

  public function afficheAjoutVoiture() {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Formulaire d'ajout d'une voiture</h3>
        <form id="form_ajout" class="fadeIn first" action="index.php?action=ajout" method="POST">
          <input type="text" id="nom_modele" name="nom_modele" placeholder="Nom du modèle">
          <input type="text" id="marque" name="marque" placeholder="Marque">
          <input type="text" id="lien_img" name="lien_img" placeholder="Lien de l'image">
          <input type="text" id="puissance_fisc" name="puissance_fisc" placeholder="Puissance fiscale">
          <input type="text" id="" name="puissance_ch" placeholder="Puissance en chevaux">
          <input type="text" id="nom_finition" name="nom_finition" placeholder="Nom de la finition">
          <input type="text" id="immat" name="immat" placeholder="Numéro d'immatriculation">
          <input type="date" id="date_immat" name="date_immat" placeholder="Date d'immatriculation">
          <input type="text" id="prix" name="prix" placeholder="Prix à la journée">
          <input type="submit" name="ajouter" value="Ajouter">
        </form>
      </div>
    </div>
    <?php
  }
}
?>