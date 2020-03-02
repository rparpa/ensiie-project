<?php
namespace Admin;
use PDO;

class AdminView {
  public function __construct() {
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