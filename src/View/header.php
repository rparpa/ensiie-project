<?php

require_once '../src/Bootstrap.php';

if(isset($_GET['logout'])){
  if($_GET['logout']==true){
    session_unset();
  }
}

?>

<html>
<head>
    <link rel="stylesheet" href='/css/fontawesome/css/all.css' type="text/css">
    <link rel="stylesheet" href='/css/style.css' type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
</head>

<body>
  <div class="hero-image">
    <div class="hero-text">
      <h1>Pokedex</h1>
      <p>Global Pokedex</p>
    </div>
  </div>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="pokedex.php">Poke-iien</a>
        </div>
        <ul class="nav navbar-nav" style="display:inline;">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/pokedex.php">Pokedex</a></li>
        <?php if(isset($_SESSION["user_login"])): ?>
          <li><a href="/account.php">Account</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right" style="display:inline;">
            <li><a href="/pokedex.php?logout=true">Logout</a></li>
          </ul>
        <?php else:?>
          </ul>
          <ul class="nav navbar-nav navbar-right" style="display:inline;">
            <li style="margin-right:5px;"><button class="button-login" onclick="document.getElementById('id02').style.display='block'"> <span class="glyphicon glyphicon-log-in"></span> Login &nbsp;</button></li>
            <li><button class="button-signup" onclick="document.getElementById('id01').style.display='block'"> <span class="glyphicon glyphicon-user"></span> Sign Up</button></li>
          </ul>
        <?php endif;?>

      </div>
    </nav>
  <?php if(isset($_GET['erreur'])): ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php if($_GET['erreur'] == 1):?>
          <p><?php echo"Mauvaise information"; ?></p>
        <?php elseif ($_GET['erreur'] == 2): ?>
          <p><?php echo"Login existe deja"; ?></p>
      <?php endif;?>
    </div>
  <?php elseif (isset($_GET['success'])):?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php if($_GET['success'] == 1):?>
          <p><?php echo"Inscription réussie, vous pouvez maintenant vous connecter."; ?></p>
        <?php endif;?>
    </div>
  <?php endif; ?>
