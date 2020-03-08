<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<!-- Container Boostrap -->
<div class="container">

	<?php
		$this->load->view('elements/filter')
	?>
		
	</header>
	<!-- Row Page -->
	
	<div class="row text-center">
		<?php
			if (count($annonces)>0){
				foreach($annonces as $annonce){
					$id_ann = $annonce["id_annonce"];
					$images = $this->image->getImage($id_ann);
					echo '<div class="col-lg-3 col-md-6 mb-4 annonce">';
					echo '<input type="hidden" value="'.$annonce["prix"].'">';
					echo '<p hidden class="categorie">'.implode(" ",$annonce["categories"]).' </p>';													

						echo '<div class="card mb-4 box-shadow ">';
						if($images==null)
							echo '<a href="#"><img class="card-img-top" src="'.base_url().'/assets/images/default.jpg" width="600" height="200" alt=""></a>';
						else if($images[0]['url']==""|| !file_exists('assets/images/'.$images[0]['url']))
							echo '<a href="#"><img class="card-img-top" src="'.base_url().'/assets/images/default.jpg" width="600" height="200" alt=""></a>';
						else
							echo '<a href="#"><img class="card-img-top" src="'.base_url().'/assets/images/'.$images[0]['url'].'" width="600" height="200" alt=""></a>';

						echo '<div class="card-body">';
								echo '<p class="card-title">';
									echo '<a href="'.site_url('/Annonce/details_annonce/'.$annonce["id_annonce"]).'">'.$annonce["titre"].'</a>';
								echo '</p>';
								echo '<div class="d-flex justify-content-between align-items-center">';
										echo '<div class="btn-group">';
										echo '</div>';
									echo '<p class="h6 prix_annonce">'.$annonce["prix"].'€</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		?>
	</div>
	<!-- /.row -->

</div>
<!-- /.container -->
