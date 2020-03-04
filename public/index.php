<?php

require_once '../src/Bootstrap.php';
session_start();
ob_start();

if (isset($_GET['api'])) {
    if ($_GET['api'] == 'fetch' && isset($_POST['string'])) { // post string kept for backward compatibility with old system
        $service = new \Car\CarSearchService(\Db\Connection::get());
        $service->fetchEveryPossibleCar($_POST['string']);
    } else if($_GET['api'] == 'search' && isset($_POST)) {
        $service = new \Car\CarSearchService(\Db\Connection::get());
        $service->searchCar($_POST);
    }
}
?>

<html>
<head>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link href="autocomplete.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="autocomplete.js"></script>
  <script type="text/javascript" src="script.js"></script>
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="https://img.icons8.com/android/24/000000/kitchen.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Cook Rental
  </a>
  <form class="form-inline my-2 my-lg-0">
    <?php if(!isset($_SESSION["name_firstname"])) { ?>
      <a class="btn btn-outline-primary" id="accueil" href='index.php?action=connect'>Se connecter</a>
      <a class="btn btn-outline-primary" href='index.php?action=register'>S'inscrire</a>
  <?php } else {?>
    Bienvenue, <?php echo $_SESSION["name_firstname"]; ?>.
    <?php if($_SESSION["role"] == 1) {?>
        <a href="index.php?action=admin">Panel admin</a> | 
    <?php } ?>
    <a href="index.php?action=logout">Se déconnecter</a>
<?php } ?>
</form>
</nav>
<link href="adminpanel.css" rel="stylesheet" type="text/css" media="screen" />
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
        } else if ($_GET['action'] == 'reset') {
            $controller = new \User\UserController(\Db\Connection::get());
            if(isset($_POST["email"])) {
                $controller->reset($_POST);
            } else {
                $controller->afficheFormulaireReset();
            }
        } else if ($_GET['action'] == 'showCar') {
            if(isset($_GET["car_id"])) {
                $controller = new \Car\CarController(\Db\Connection::get());
                $controller->afficheVoiture($_GET['car_id']);
            }
        } else if ($_GET['action'] == 'location') {
            $controller = new \Car\CarController(\Db\Connection::get());
            if(isset($_POST["date_debut"])) {
                $controller->createLocation($_POST);
            }
        } else if ($_GET['action'] == 'admin') {
            $controller = new \Admin\AdminController(\Db\Connection::get());
            //$controller->afficheLocations(); A CORRIGER
            $controller->afficheVoitures();
        } else if ($_GET['action'] == 'ajouter') {
            $controller = new \Admin\AdminController(\Db\Connection::get());
            if(isset($_POST["nom_modele"])) {
                $controller->ajoutVoiture($_POST);
            } else {
                $controller->afficheAjoutVoiture();
            }
        } else if ($_GET['action'] == 'modifVoiture') {
            $controller = new \Admin\AdminController(\Db\Connection::get());
            if(isset($_POST["nom_modele"])) {
                $controller->modifVoiture($_POST);
            } else {
                $controller->afficheModifVoiture($_GET['car_id']);
            }
        }  else if ($_GET['action'] == 'deleteVoiture') {
                $controller = new \Admin\AdminController(\Db\Connection::get());
                $controller->deleteVoiture($_POST);
        }   else if ($_GET['action'] == 'deleteLocation') {
                $controller = new \Admin\AdminController(\Db\Connection::get());
                $controller->deleteLocation($_POST);
        }
    } else {
        ?><link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <div id="logo" class="container">
          <h1><a href="#">CookRental</a></h1>
          <p>Vous êtes à la recherche d'une voiture rapidement, nous somme la solution.</p>
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
                        <input type="text" id="voiture" class="autocomplete" name="voiture" placeholder="Marque, modele, ...">
                    </dl>
                </div>
                <div class="col-lg-4">
                    <dl class="param param-feature">
                        <dt>Budget</dt>
                        <input type="number" name="budget" placeholder="Budget">
                    </dl>
                </div>
                <div class="col-lg-8">
                    <a style="color:white;" id="sendRq" type="button" class="btn btn-danger">Trouver la voiture de mes rêves</a>
                </div>
            </div>
            <div class="entry">
                <p>Voici notre liste de voitures disponibles a la location, Vous trouverez tous les détails en cliquant sur le prix.</p>
            </div>
        </div>
        </div><?php
        $carController = new \Car\CarController(\Db\Connection::get());
        $carController->afficheVoituresIndex();
    }
    ob_end_flush();
    ?>
</div>
</body>
</html>
