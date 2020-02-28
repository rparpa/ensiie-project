<!DOCTYPE html>
<html lang="fr">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>AnnoncIIE</title>

	<!-- CSS Bootstrap -->
	<link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- CSS customisé -->
	<link href="../../assets/css/annonce.css" rel="stylesheet">

</head>

<body>

<!-- Menu de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">AnnoncIIE</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Annonce
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Administration</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Mon profil
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">A propos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Se déconnecter</a>
				</li>
			</ul>
		</div>
		<button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/create/'?>');">Ajouter</button>
	</div>
</nav>

<!-- Container Boostrap -->
<div class="container">

	<!-- Jumbotron Header -->
	<header class="jumbotron my-4">
	</header>

	<!-- Row Page -->
	<div class="row text-center">

		<div class="col-lg-3 col-md-6 mb-4">
			<div class="card h-20">
				<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
				<div class="card-body">
					<h4 class="card-title">
						<a href="#">Titre 1 annonce</a>
					</h4>
					<div class="card-footer">
						<h5>24.99€</h5>
					</div>
				</div>
				<!--mettre en place une boucle foreach en php, qui sera de la forme :
				$id = $_GET['id']
				URL = $this->image_model->getImage($id);
				Reproduit comme l'exemple en-dessus -->
				<?php

				?>
			</div>
		</div>
		<button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/update/'?>');">Modifier</button>
		<button type="button" class="btn btn-success" onclick="window.location.replace('<?php  echo base_url().'index.php/annonce/delete/'?>');">Supprimer</button>
	</div>
	<!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Copyright &copy; AnnoncIIE 2020</p>
	</div>
	<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="../../assets/jquery/jquery.min.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
