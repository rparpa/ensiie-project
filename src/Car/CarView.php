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
              <div class="image"><img src="<?php echo $voiture->getImage(); ?>" width="324" height="200" alt="" /></div>
              <h2><?php echo $voiture->getMarque() . " " . $voiture->getModele(); ?></h2>
              <p><?php echo $voiture->getFinition() . " " . $voiture->getPuissance() . "ch"; ?></p>
              <a href="#" class="button">A partir de <?php echo $voiture->getPrix() . " €"; ?></a>
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
                  <div> <a href="#"><img src="<?php echo $voiture->getImage(); ?>" style="width: 100%;"></a></div>
                </div>
                <div class="img-small-wrap">
                  <div class="item-gallery"> <img src=""> </div>
                  <div class="item-gallery"> <img src=""> </div>
                  <div class="item-gallery"> <img src=""> </div>
                  <div class="item-gallery"> <img src=""> </div>
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
                <dl class="param param-feature">
                  <dt>Début de location</dt>
                  <input type="date" name="birthday" placeholder="Date de naissance">
                </dl>
                <dl class="param param-feature">
                  <dt>Fin de location</dt>
                  <input type="date" name="birthday" placeholder="Date de naissance">
                </dl>

                <a href="#" class="btn btn-lg btn-primary text-uppercase">Réserver maintenant</a>
                <a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i>Ajouter au panier</a>
              </article>
            </aside>
          </div>
        </div>
      </div>
      <?php
      }
    }
}
?>