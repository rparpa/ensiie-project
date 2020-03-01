<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<!-- Menu de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

		<a class="navbar-brand" href="<?php echo site_url('/Annonce/liste_annonces'); ?>">AnnoncIIE</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Annonce
						<span class="sr-only">(current)</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo site_url('/Annonce/liste_annonces'); ?>">Lister les annonces</a>
						<a class="dropdown-item" href="#">Mes annonces...</a>
						<a class="dropdown-item" href="<?php echo site_url('/Annonce/ajouter_annonce'); ?>">Ajouter une annonce...</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Administration</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">A propos</a>
				</li>
				<?php if(isset($email)) { // TODO : il faut qu'on teste l'existence des variables sessions
					echo "<li class=\"nav-item\">
					<a class=\"nav-link\" href=".base_url()."index.php/authentification/profil>Mon profil ($nom $prenom)</a>
				</li>";
					echo "<li class=\"nav-item\">
					<a class=\"nav-link glyphicon glyphicon-log-in\" href=".base_url()."index.php/authentification/logout>Se déconnecter</a>
				</li>";
				}
				?>

			</ul>
		</div>
		
		<button type="button" class="btn btn-success" onclick="window.location.replace('<?php echo site_url('/Annonce/ajouter_annonce'); ?>');">Nouvelle annonce ...</button>
		<div class="dropdown open">
			<button class="btn btn-secondary dropdown-toggle"
					type="button" id="dropdownMenu5" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle"></i>
					<!--https://www.w3schools.com/icons/fontawesome5_icons_users_people.asp-->
			</button>
			
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="<?php echo site_url('/utilisateur/profil'); ?>">Mon profil</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo site_url('/authentification/logout'); ?>">Se déconnecter</a>
			</div>
		</div>

</nav>