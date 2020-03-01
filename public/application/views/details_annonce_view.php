<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<!-- Container Boostrap -->
</br>
<div class="container">
    <div class="card ">
        <h5 class="card-header text-white bg-primary"><?php echo $details_annonce[0]['titre']?></h5>
        <div class="card-body">
            <div class='row'>
                <div class="col-md">
                    <h6 class="card-title text-justify"><?php echo $details_annonce[0]['description']?></h6>
                    <h6 class="card-title text-justify"><?php echo 'Vendu par '.$user_annonce[0]['nom'].' '.$user_annonce[0]['prenom'].' , '.$user_annonce[0]['email']?></h6>    
                    <h6 class="font-italic card-title text-justify"><?php echo 'Publiée le '.$details_annonce[0]['date_publication']?></h6>               
                </div>
                <div class="col-md">
                <?php
                    if(!isset($image[0]['url']))
                        echo '<a><img class="rounded float-right img-thumbnail" src="'.base_url().'/assets/images/default.jpg" alt=""></a>';
                    else
                        echo '<a><img class="rounded float-right img-thumbnail" src="'.base_url().'/assets/images/'.$image[0]['url'].'" alt=""></a>';
                ?>
                </div>
            </div>
            </br>

            <div class='row'>
                <div class="col-md">
                    <h4><span class="badge badge-info">Categorie</span></h4>
                    <h4 class="font-weight-bold text-md-right card-title"><?php echo $etat_annonce[0]['etat']?></h4>
                    <h4 class="font-weight-bold text-md-right card-title"><?php echo $details_annonce[0]['prix'].'€'?></h4>
                </div>
            </div>
        </div>
    </div>




