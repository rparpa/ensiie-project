<?php include('../src/View/header.php') ?>

<?php if(isset($_GET['id'])){
        if($_GET['id'] != ''){
          $pokemonRepository = new Model\Entity\Pokemon\PokemonRepository(\Db\Connection::get());
          $favoriteRepository = new Model\Entity\Favorie\FavorieRepository(\Db\Connection::get());
          //FAIRE TEST SI LE POKEMON N'EXISTE PAS + EXPRESSION REGULIERE POUR EVITER DE CHERCHE NIMPIRTE QUOI AVEC L'URL
          $id_pokemon = $_GET['id'];
          $pokemon = $pokemonRepository->findById($id_pokemon);
        }else{
          header('Location: pokedex.php');
        }
      }else{
        header('Location: pokedex.php');
      }
      //var_dump($pokemon);die;
      //var_dump($favoriteRepository->isFavorie($_GET['id'],$_SESSION["user_login"]));
?>
<div class="container">

  <div class="row" id="divFav">
    <h1>#<?php echo $pokemon->getPokedex_Number();?> <?php echo $pokemon->getFrench_Name();?></h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if(isset($_SESSION["user_login"])): ?>
      <?php if($favoriteRepository->isFavorie($_GET['id'],$_SESSION["user_login"])): ?>
        <button type="submit" class="btn btn-info btn-lg waves-effect" onclick="delFav();" id="btnDel"><span class="glyphicon glyphicon-star" style="color:red;"></span></button>
      <? else:?>
        <button type="submit" class="btn btn-info btn-lg waves-effect" onclick="addFav();" id="btnAdd"><span class="glyphicon glyphicon-star" ></span></button>
      <?php endif;?>
    <?php endif;?>
  </div>

  <div class="row">
      <div class="col-sm-6 col-xs-12">
        <?php
          if($pokemon->getPokedex_Number()<100){
            if($pokemon->getPokedex_Number()<10){
              echo '<img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/00'.$pokemon->getPokedex_Number().'.png">';
            }else{
              echo '<img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/0'.$pokemon->getPokedex_Number().'.png">';
            }
          }else{
            echo '<img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/'.$pokemon->getPokedex_Number().'.png">';
          }
        ?>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="panel panel-info">
          <div class="panel-heading">Statistique</div>
          <table class="table table-condensed text-center">
            <tr>
              <td>Type</td>
              <td class="text"><img src="/img/<?php echo $pokemon->getType1();?>.png">
              <?php if($pokemon->getType2()!=""){echo '<img src="/img/'.$pokemon->getType2().'.png">';}?></td>
            </tr>
            <tr>
              <td>PV</td>
              <td class="text"><?php echo $pokemon->getHp();?></td>
            </tr>
            <tr>
              <td>Attaque</td>
              <td class="text"><?php  echo $pokemon->getAttack();?></td>
            </tr>
            <tr>
              <td>Défense</td>
              <td class="text"><?php echo $pokemon->getDefense();?></td>
            </tr>
            <tr>
              <td>Attaque spé	</td>
              <td class="text"><?php echo $pokemon->getSp_Attack();?></td>
            </tr>
            <tr>
              <td>Défense spé</td>
              <td class="text"><?php echo $pokemon->getSp_Defense();?></td>
            </tr>
            <tr>
              <td>Vitesse</td>
              <td class="text"><?php echo $pokemon->getSpeed();?></td>
            </tr>
            <tr style="background-color:red; color:white;">
              <td><b>Total base stat</b></td>
              <td class="text"><b><?php echo $pokemon->getBase_Total();?></b></td>
            </tr>
          </table>

        </div>
      </div>
  </div>

  <br><br><br>

  <div class="row">
    <div class="col-md-12">
      <div class="table-container">
        <table class="table table-condensed table-responsive table-bordered2 text-center">
          <tbody>
            <tr>
              <th></th>
              <th class="text-center" colspan="18" > Faiblesse de <?php echo $pokemon->getFrench_Name();?></th>
            </tr>
            <tr>
              <td></td>
              <td><img src="/img/bug.png"></td>
              <td><img src="/img/dark.png"></td>
              <td><img src="/img/dragon.png"></td>
              <td><img src="/img/electric.png"></td>
              <td><img src="/img/fairy.png"></td>
              <td><img src="/img/fighting.png"></td>
              <td><img src="/img/fire.png"></td>
              <td><img src="/img/flying.png"></td>
              <td><img src="/img/ghost.png"></td>
              <td><img src="/img/grass.png"></td>
              <td><img src="/img/ground.png"></td>
              <td><img src="/img/ice.png"></td>
              <td><img src="/img/normal.png"></td>
              <td><img src="/img/poison.png"></td>
              <td><img src="/img/psychic.png"></td>
              <td><img src="/img/rock.png"></td>
              <td><img src="/img/steel.png"></td>
              <td><img src="/img/water.png"></td>
            </tr>
            <tr>
              <td></td>
              <td <?php if($pokemon->getAgainst_Bug()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Bug()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Bug();?></td>
              <td <?php if($pokemon->getAgainst_Dark()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Dark()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Dark();?></td>
              <td <?php if($pokemon->getAgainst_Dragon()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Dragon()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Dragon();?></td>
              <td <?php if($pokemon->getAgainst_Electric()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Electric()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Electric();?></td>
              <td <?php if($pokemon->getAgainst_Fairy()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Fairy()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Fairy();?></td>
              <td <?php if($pokemon->getAgainst_Fight()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Fight()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Fight();?></td>
              <td <?php if($pokemon->getAgainst_Fire()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Fire()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Fire();?></td>
              <td <?php if($pokemon->getAgainst_Flying()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Flying()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Flying();?></td>
              <td <?php if($pokemon->getAgainst_Ghost()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Ghost()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Ghost();?></td>
              <td <?php if($pokemon->getAgainst_Grass()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Grass()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Grass();?></td>
              <td <?php if($pokemon->getAgainst_Ground()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Ground()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Ground();?></td>
              <td <?php if($pokemon->getAgainst_Ice()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Ice()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Ice();?></td>
              <td <?php if($pokemon->getAgainst_Normal()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Normal()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Normal();?></td>
              <td <?php if($pokemon->getAgainst_Poison()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Poison()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Poison();?></td>
              <td <?php if($pokemon->getAgainst_Psychic()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Psychic()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Psychic();?></td>
              <td <?php if($pokemon->getAgainst_Rock()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Rock()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Rock();?></td>
              <td <?php if($pokemon->getAgainst_Steel()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Steel()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Steel();?></td>
              <td <?php if($pokemon->getAgainst_Water()< 1){echo 'style="background-color:#aaffaa;"';}elseif($pokemon->getAgainst_Water()> 1){echo 'style="background-color:#ffaaaa;"';}?>><?php echo $pokemon->getAgainst_Water();?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <br><br><br>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading text-center">Information</div>
        <table class="table table-condensed ">
          <tr>
            <td><b>Genre</b></td>
            <td>
            <?php if($pokemon->getPercentage_Male() != null):?>
              <div class="progress" style="margin-bottom:0">
                <div class="progress-bar progress-bar-info" style="width:<?php echo $pokemon->getPercentage_Male();?>%"><i class="fa fa-mars"></i></div>
                <div class="progress-bar progress-bar-danger" style="width:<?php echo 100 - $pokemon->getPercentage_Male();?>%"><i class="fa fa-venus"></i></div>
              </div>
              <div class="small text-center">
                Mâle : <?php echo $pokemon->getPercentage_Male();?>%
                <br>
                Femelle : <?php echo 100 - $pokemon->getPercentage_Male();?>%
              </div>
            <?php else:?>
              <i>Sans Genre </i>
            <?php endif;?>
            </td>

            <td><b>Generation</b></td>
            <td><?php echo $pokemon->getGeneration();?></td>
          </tr>

          <tr>
            <td><b>Abilité</b></td>
            <td><?php echo $pokemon->getAbilities();?></td>

            <td><b>Classification</b></td>
            <td><?php echo $pokemon->getClassfication();?></td>
          </tr>
          <tr>
            <td><b>Nombre de pas avant éclosion</b></td>
            <td><?php echo $pokemon->getBase_Egg_Steps();?></td>

            <td><b>Bonheur</b></td>
            <td><?php echo $pokemon->getBase_Happiness();?></td>
          </tr>
          <tr>
            <td><b>Taux de capture</b></td>
            <td><?php echo $pokemon->getCapture_Rate();?></td>

            <td><b>Experience Max</b></td>
            <td><?php echo $pokemon->getExperience_Growth();?></td>
          </tr>

          <tr>
            <td><b>Taille</b></td>
            <td><?php echo $pokemon->getHeight_M();?> <b><i>M</i></b></td>

            <td><b>Poids</b></td>
            <td><?php echo $pokemon->getWeight_Kg();?> <b><i>Kg</i></b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  function addFav(){
    var pokemon_id = "<?php echo $_GET['id'];?>";
    var id_user = "<?php echo $_SESSION["user_login"];?>";

    $.ajax({
      url:'ApplicationController.php',
      dataType:'html',
      data:{action: "addFav",pokemon_id:pokemon_id, id_user: id_user},
      type:"POST",
      success: function (data, statut){
        var mydiv = document.getElementById('divFav');
        mydiv.insertAdjacentHTML('beforeend', data);
        document.getElementById('btnAdd').remove();
        //alert(data);
      }
    });
  }

  function delFav(){
    var pokemon_id = "<?php echo $_GET['id'];?>";
    var id_user = "<?php echo $_SESSION["user_login"];?>";

    $.ajax({
      url:'ApplicationController.php',
      dataType:'html',
      data:{action: "delFav",pokemon_id:pokemon_id, id_user: id_user},
      type:"POST",
      success: function (data, statut){
        var mydiv = document.getElementById('divFav');
        mydiv.insertAdjacentHTML('beforeend', data);
        document.getElementById('btnDel').remove();
      }
    });
  }

</script>

<?php include('../src/View/footer.php') ?>
