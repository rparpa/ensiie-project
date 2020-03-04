<?php
namespace Admin;
use PDO;

class AdminView {
  public function __construct() {
  }

  public function afficheLocations($locations) {
    ?>
    <div class="row">
    <div id="carpool-header" class="container">
      <div>
        <div class="entry">
        <h2 style="text-align: center">Liste des locations en cours</h2>
        <p style="text-align: center">Résumer des locations actuellement en cours, possibilité d'annuler la location.</p>
        </div>
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
            <form action="index.php?action=deleteLocation" method="post">
              <h2><?php echo $location->getVoitureImmat(); ?></h2>
              <p><?php echo $location->getUserEmail() . " " . $location->getKmMax() . "km max"; ?></p>
              <p><?php echo $location->getDateDebut()->format('Y-m-d H:i:s') . " " . $location->getDateFin()->format('Y-m-d H:i:s') . " "; ?></p>
              <input type="hidden" id="location_id" name="location_id" value="<?php echo $location->getId();?>"> 
              <input type="submit" value="Supprimer" class="button">
            </form>
          </div>
        </div>
      </div>
      <?php
      $i++;
      if($i % 3 == 0) {
        ?></div><?php
      }
    }
    ?></div><?php
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
    <div id="columnsCars">
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
              <form action="index.php?action=modifVoiture" method="post">
                <input type="hidden" id="car_id" name="car_id" value="<?php echo $voiture->getId();?>"> 
                <input type="submit" value="Modifier" class="button">
              </form>
              <form action="index.php?action=deleteVoiture" method="post">
                <input type="hidden" id="car_id" name="car_id" value="<?php echo $voiture->getId();?>"> 
                <input type="submit" value="Supprimer" class="button">
              </form>
          </div>
        </div>
      </div>
      <?php
      $i++;
      if($i % 3 == 0) {
        ?></div><?php
      }
    }
    ?></div><?php
  }

  public function afficheAjoutVoiture() {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Ajout d'une voiture</h3>
        <form id="form_ajout" class="fadeIn first" action="index.php?action=ajouter" method="POST">
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

  public function afficheAjout($post) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form action="index.php">
          <h3 class="fadeIn first title">Ajout d'une voiture</h3>
          <h7 class="fadeIn first">L'ajout de la voiture <b><?php echo $post["nom_modele"]; ?></b> a été pris en compte.</h7>
          <input id="accueil" type="submit" value="Retourner à l'accueil"/>
        </form>
      </div>
    </div>
    <?php
  }

  public function afficheModifVoiture($voiture) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Modification d'une voiture</h3>
        <form id="form_modif" class="fadeIn first" action="index.php?action=modifVoiture" method="POST">
          <input type="text" id="nom_modele" name="nom_modele" value="<?php echo $voiture->getModele(); ?>" placeholder="Nom du modèle">
          <input type="text" id="marque" name="marque" placeholder="Marque" value="<?php echo $voiture->getMarque(); ?>">
          <!--<input type="text" id="lien_img" name="lien_img" value="<?php //echo $voiture->getImage(); ?>" placeholder="Lien de l'image">-->
          <input type="text" id="" name="puissance_ch" value="<?php echo $voiture->getPuissance(); ?>" placeholder="Puissance en chevaux">
          <input type="text" id="nom_finition" name="nom_finition" value="<?php echo $voiture->getFinition(); ?>" placeholder="Nom de la finition">
          <input type="text" id="immat" name="immat" value="<?php echo $voiture->getImmat(); ?>" placeholder="Numéro d'immatriculation">
          <!--<input type="date" id="date_immat" name="date_immat" value="<?php //echo $voiture->getDateImmat()->format('Y-m-d'); ?>" placeholder="Date d'immatriculation">-->
          <input type="text" id="prix" name="prix" value="<?php echo $voiture->getPrix(); ?>" placeholder="Prix à la journée">
          <input type="hidden" name="car_id" value="<?php echo $voiture->getId(); ?>" />
          <input type="submit" name="modifier" value="Modifier">
        </form>
      </div>
    </div>
    <?php
  }

  public function afficheModif($post) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form action="index.php">
          <h3 class="fadeIn first title">Modification d'une voiture</h3>
          <h7 class="fadeIn first">La modification de la voiture <b><?php echo $post["nom_modele"]; ?></b> a été prise en compte.</h7>
          <input id="accueil" type="submit" value="Retourner à l'accueil"/>
        </form>
      </div>
    </div>
    <?php
  }

  public function afficheDelete($post) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form action="index.php">
          <h3 class="fadeIn first title">Suppression d'une voiture</h3>
          <h7 class="fadeIn first">La suppression de la voiture numéro <b><?php echo $post['car_id']; ?></b> a été prise en compte.</h7>
          <input id="accueil" type="submit" value="Retourner à l'accueil"/>
        </form>
      </div>
    </div>
    <?php
  }

  public function afficheDeleteLocation($post) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form action="index.php">
          <h3 class="fadeIn first title">Suppression d'une location</h3>
          <h7 class="fadeIn first">La suppression de la location numéro <b><?php echo $post['location_id']; ?></b> a été prise en compte.</h7>
          <input id="accueil" type="submit" value="Retourner à l'accueil"/>
        </form>
      </div>
    </div>
    <?php
  }
}
?>