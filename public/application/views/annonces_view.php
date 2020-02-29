<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<!-- Container Boostrap -->
<div class="container">

	<!-- Jumbotron Header -->
	<header class="jumbotron my-4">
	</header>

	<!-- Row Page -->
	<div class="row text-center">
		<?php
			if (count($annonces)>0){
				foreach($annonces as $annonce){

					echo '<div class="col-lg-3 col-md-6 mb-4">';
						echo '<div class="card mb-4 box-shadow">';
							echo '<img class="card-img-top" src="http://placehold.it/700x400" alt="Card image cap">';
								echo '<div class="card-body">';
								echo '<p class="card-title">';
									echo '<a href="#">'.$annonce["titre"].'</a>';
								echo '</p>';									
								echo '<div class="d-flex justify-content-between align-items-center">';
										echo '<div class="btn-group">';
										//echo '<button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>';
										echo '</div>';
									echo '<p class="h6">'.$annonce["prix"].'€</p>';
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


<!-- Bootstrap core JavaScript -->
<script src="../../assets/jquery/jquery.min.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
