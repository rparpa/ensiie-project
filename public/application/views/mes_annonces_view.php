<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<!-- Container Boostrap -->
<div class="container">

	<!-- Jumbotron Header -->
	<header class="jumbotron my-4">
		<div>
			<form method="post" action="<?php  echo base_url().'index.php/annonce/filter/'.$id_user?>">
				<input type="number" id="min" name="min" value="<?php echo $min;?>">
				<input type="number" id="max" name="max" value="<?php echo $max;?>">
				<input type="submit" id="filtre" name="filtre" value="Filtrer">
			</form>
		</div>
	</header>
	<!-- Row Page -->
	<div class="row text-center">
		<?php
			if (count($mes_annonces)>0){
				foreach($mes_annonces as $annonce){
					$id_ann = $annonce["id_annonce"];
					$images = $this->image->getImage($id_ann);
					echo '<div class="col-lg-3 col-md-6 mb-4">';
						echo '<div class="card mb-4 box-shadow">';
						if(!isset($images[0]['url']))
							echo '<a href="#"><img class="card-img-top" src="'.base_url().'/assets/images/default.jpg" width="600" height="200" alt=""></a>';
						else
							echo '<a href="#"><img class="card-img-top" src="'.base_url().'/assets/images/'.$images[0]['url'].'" width="600" height="200" alt=""></a>';
		
						echo '<div class="card-body">';
								echo '<p class="card-title">';
									echo '<a href="'.site_url('/Annonce/details_annonce/'.$annonce["id_annonce"]).'">'.$annonce["titre"].'</a>';
                                echo '</p>';
                                echo '<div class="d-flex justify-content-between align-items-center">';
								echo '<div class="btn-group">';
						?>
								<button type="button" class="btn btn-sm btn-outline-warning" onclick="window.location.replace('<?php echo site_url('/Annonce/modifier_annonce/'.$annonce['id_annonce']); ?>');">Modifier</button>
								<button type="button" class="btn btn-sm btn-outline-danger">Supprimer</button>
						<?php
                                echo '</div>';
								echo '<div class="d-flex justify-content-between align-items-center">';
									echo '<p class="h6">'.$annonce["prix"].'€</p>';
                                echo '</div>';                                
                                echo '</div>';									
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		?>

		<!-- <button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/update/'?>');">Modifier</button> -->
		<!-- <button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/delete/'?>');">Supprimer</button> -->
	</div>
	<!-- /.row -->

</div>
<!-- /.container -->