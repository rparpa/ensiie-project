<?php

require_once '../src/Bootstrap.php';
session_start();
?>

<html>
<head>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="https://img.icons8.com/android/24/000000/kitchen.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Cook Rental
    </a>
    <form class="form-inline my-2 my-lg-0">
    <?php if(!isset($_SESSION["name_firstname"])) { ?>
      <a class="btn btn-outline-primary" id="btn_header" href='index.php?action=connect'>Se connecter</a>
      <a class="btn btn-outline-primary" href='index.php?action=register'>S'inscrire</a>
    <?php } else {?>
        Bienvenue, <?php echo $_SESSION["name_firstname"]; ?>.
        <?php if($_SESSION["role"] == 1) {?>
            <a href="index.php?action=admin">Panel admin</a> | 
        <?php } ?>
         <a href="index.php?action=logout"> Se déconnecter</a>
    <?php } ?>
    </form>
  </nav>

<div id="wrapper">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listUsers') {
            $controller = new \User\UserController(\Db\Connection::get());
            $users = $controller->listUsers();
        } else if ($_GET['action'] == 'connect') {
            $controller = new \User\UserController(\Db\Connection::get());
            if(isset($_POST["email"])) {
                $controller->identification($_POST);
            } else {
                $controller->afficheFormulaireConnexion();
            }
        } else if ($_GET['action'] == 'logout') {
            $controller = new \User\UserController(\Db\Connection::get());
            $controller->deconnexion();
        } else if ($_GET['action'] == 'register') {
            $controller = new \User\UserController(\Db\Connection::get());
            if(isset($_POST["email"])) {
                $controller->enregistrement($_POST);
            } else {
                $controller->afficheFormulaireInscription();
            }
        } else if ($_GET['action'] == 'showCar') {
            if(isset($_GET['car_id'])) {
                $controller = new \Car\CarController(\Db\Connection::get());
                $controller->afficheVoiture($_GET['car_id']);
            }
        } else if ($_GET['action'] == 'admin') {
            $controller = new \Admin\AdminController(\Db\Connection::get());
            $controller->afficheVoitures();
        }
    } else {
        ?><link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <div id="logo" class="container">
		<h1><a href="#">CookRental</a></h1>
		<p>You are cooked and looking for a car quickly, we are the solution.</p>
	</div>
	<div id="page" class="container">
		<div>
                <div class="row">
                    <div class="col-lg-4">
                        <dl class="param param-feature">
                        <dt>Début de location</dt>
                        <input type="date" name="datedeb" placeholder="Début de location">
                        </dl>
                    </div>
                    <div class="col-lg-4">
                        <dl class="param param-feature">
                        <dt>Fin de location</dt>
                        <input type="date" name="datefin" placeholder="Fin de location">
                        </dl>
                    </div>
                    <div class="col-lg-4">
                        <dl class="param param-feature">
                        <dt>Marque, modèle ...</dt>
                        <input type="text" name="voiture" placeholder="Marque, modele, ...">
                        </dl>
                    </div>
                    <div class="col-lg-4">
                        <dl class="param param-feature">
                        <dt>Budget</dt>
                        <input type="text" name="budget" placeholder="Budget">
                        </dl>
                    </div>
                    <div class="col-lg-8">
                        <a style="color:white;" type="button" class="btn btn-danger">Trouver la voiture de mes rêves</a>
                    </div>
                </div>
			<div class="entry">
				<p>Below is our list of cars available for hire.<br>
					You will find all the details by clicking on "More details".</p>
			</div>
		</div>
	</div><?php
        $carController = new \Car\CarController(\Db\Connection::get());
        $carController->afficheVoituresIndex();
    }
    ?>
</div>
</body>
</html>
