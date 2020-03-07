<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<?php
$date = new DateTime($details_annonce[0]['date_publication']);

?>
<!-- Container Boostrap -->
</br>
<div class="container">
    <div class="card ">
        <div class='card-header bg-primary'>
        <div class="d-flex justify-content-between">
            <h5 class="text-white"><?php echo $details_annonce[0]['titre']?></h5>
            <?php echo '<div class="float-right btn-group">';
                    if($details_annonce[0]['id_user']!=$id_user){
                        ?>
                            <button type="button" id="Signaler" name="Signaler" class="btn btn-sm btn-outline-warning" onclick="window.location.replace('<?php echo site_url('/Annonce/signaler_annonce/'.$details_annonce[0]['id_annonce']); ?>');">Signaler</button>
                        <?php
                    }
                    echo '</div>';
            ?>
        </div>
        </div>
        
        <div class="card-body">
            <div class='row'>
                <div class="col-md">
                    <h6 class="card-title text-justify"><?php echo $details_annonce[0]['description']?></h6>
                    <h6 class="card-title text-justify"><?php echo 'Vendu par '.$user_annonce[0]['nom'].' '.$user_annonce[0]['prenom'].' , '.$user_annonce[0]['email']?></h6>    
                    <h6 class="font-italic card-title text-justify"><?php echo 'Publiée le '.$date->format('d-m-Y H:i:s')?></h6>               
                </div>
                <div class="col-md ">
                <?php
                    if($image==null)
                        echo '<a><img class="rounded float-right img-fluid" src="'.base_url().'/assets/images/default.jpg" alt=""></a>';           
                    else if($image[0]['url']==""|| !file_exists('assets/images/'.$image[0]['url']))
                        echo '<a><img class="rounded float-right img-fluid" src="'.base_url().'/assets/images/default.jpg" alt=""></a>';
                    else
                        echo '<a><img class="rounded float-right img-fluid" src="'.base_url().'/assets/images/'.$image[0]['url'].'" alt=""></a>';
                ?>
                </div>
            </div>
            </br>

            <div class='row'>
                <div class="col-md">
                <?php 
                if (count($categorie_annonce)>0){
                    echo '<div class="d-flex flex-row mx-md-n6">';
                    foreach($categorie_annonce as $i => $categorie){ 
                        echo '<div class="px-md-2"><h4><span class="border badge badge-info">'.$categorie['categorie'].'</span></h4></div>';
                    }
                    echo '</div>';
                }
                ?>
                    <h4 class="font-weight-bold text-md-right card-title"><?php echo $etat_annonce[0]['etat']?></h4>
                    <h4 class="font-weight-bold text-md-right card-title"><?php echo $details_annonce[0]['prix'].'€'?></h4>
                </div>
            </div>
        </div>
    </div>




