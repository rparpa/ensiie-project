<?php
namespace Car;
use PDO;

class CarView {
  public function __construct() {
  }

  public function afficheVoituresIndex($voitures) {
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
            <a href="index.php?action=showCar&car_id=<?php echo $voiture->getId();?>" class="button">A partir de <?php echo $voiture->getPrix() . " €"; ?></a>
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
    foreach($voitures as $voiture) {
      ?>
      <div class="fadeIn first title">
        <div class="card">
          <div class="row">
            <aside class="col-sm-5 border-right">
              <article class="gallery-wrap"> 
                <div class="img-big-wrap">
                  <div><a href="#"><img id="car-img" src="<?php echo $voiture->getImage(); ?>" style="width: 100%;"></a></div>
                </div>
              </article>
            </aside>
            <aside class="col-sm-7">
              <article class="card-body p-5">
                <h3 class="title mb-3"><?php echo $voiture->getMarque() . " " . $voiture->getModele() . " " . $voiture->getFinition() . " " . $voiture->getPuissance() . "ch"; ?></h3>

                <p class="price-detail-wrap"> 
                  <span class="price h3 text-warning"> 
                    <span class="num"><?php echo $voiture->getPrix() . "€"; ?></span>
                  </span> 
                  <span>/ jour</span> 
                </p>
                <dl class="item-property">
                  <dt>Finition</dt>
                  <dd><p><?php echo $voiture->getFinition(); ?></p></dd>
                </dl>
                <dl class="param param-feature">
                  <dt>Modèle</dt>
                  <dd><?php echo $voiture->getModele(); ?></dd>
                </dl>
                <dl class="param param-feature">
                  <dt>Marque</dt>
                  <dd><?php echo $voiture->getMarque(); ?></dd>
                </dl>
                <dl class="param param-feature">
                  <dt>Puissance</dt>
                  <dd><?php echo $voiture->getPuissance() . " ch"; ?></dd>
                </dl>
                <form id="form_location" action="index.php?action=location" method="POST">
                  <dt>Début de location</dt>
                  <input type="date" id="debut" name="date_debut" placeholder="Start location">
                  <dt>Fin de location</dt>
                  <input type="date" id="fin" name="date_fin" placeholder="End location">
                  <dt>Distance parcourue estimée</dt>
                  <input type="text" id="km_max" name="km_max" placeholder="km_max">
                  <input type="hidden" name="id_voiture" value="<?php echo $voiture->getId(); ?>" />
                  <input type="submit" name="location" value="Réserver maintenant !">
                </form>
              </article>
            </aside>
          </div>
        </div>
      </div>
      <?php
    }
  }

  public function afficheLocation($location) {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form action="index.php">
          <h3 class="fadeIn first title">Demande de location</h3>
          <h7 class="fadeIn first">Votre demande de location de voiture du  <?php echo $location["date_debut"]; ?> au <?php echo $location["date_fin"]; ?> a été prise en compte.</h7>
          <input id="accueil" type="submit" value="Retourner à l'accueil"/>
        </form>
      </div>
    </div>
    <?php
  }
}
?>