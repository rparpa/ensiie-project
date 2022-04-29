<?php
require_once '../../vendor/autoload.php';
include "../../src/templates/structure.php";
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/check-auth.js"></script>
    <script src="../static/js/templates.js"></script>
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/display-img.js"></script>
    <script src="../static/js/check-form-item.js"></script>
    <script src="../static/js/request-user.js"></script>
</head>
<body onload="getAllUsers()">
<main>
    <!-- Au clic  sur le logo "accéder page admin", le menu à gauche change pour donner la possibilité de choisir des
    menus admin, et si on reclic sur ce logo, on revient en mode "utilisateur" -->
    <div>
        Barre de recherche
    </div>
    <section class="all-users-container">
    </section>
</main>
</body>
</html>