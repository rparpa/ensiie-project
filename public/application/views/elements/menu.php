<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<!-- Menu de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">AnnoncIIE</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Annonce
						<span class="sr-only">(current)</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="#">Lister les annonces</a>
						<a class="dropdown-item" href="#">Mes annonces...</a>
						<a class="dropdown-item" href="#">Ajouter une annonce...</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Mon profil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Administration</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">A propos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link glyphicon glyphicon-log-in" href="#">Se déconnecter</a>
				</li>
			</ul>
		</div>
		<button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/create/'?>');">Ajouter</button>
	</div>
</nav>