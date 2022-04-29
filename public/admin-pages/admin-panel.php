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
</head>
<body>
<main>
    <!-- Au clic  sur le logo "accéder page admin", le menu à gauche change pour donner la possibilité de choisir des
    menus admin, et si on reclic sur ce logo, on revient en mode "utilisateur" -->
    <div>
        Barre de recherche
    </div>
    <section class="all-users-container grid">
        <div class="all-users-item">
            <div class="user-item-image">
                <img src="../static/assets/zoro.jpg" class="photo"/>
            </div>
            <div class="user-item-infos">
                <div class="all-user-item-info user-item-email">
                    <p> Email : lemeilleurhackerdu92enfinjepensequejepasseaprèsJoanthanMaisjesuispasûrtototototo@gmail.com</p>
                </div>
                <div class="all-user-item-info user-item-username">
                    <p>Pseudo : MichelDu92140</p>
                </div>
                <div class="all-user-item-info user-item-firstname">
                    <p> Prénom : Jonathan </p>
                </div>
                <div class="all-user-item-info user-item-lastname">
                    <p> Nom : Jusseaume </p>
                </div>
            </div>
            <div class="button-ban">Bannir</div> <!-- Ne pas oublier de faire le bouton "débannir--> <!-- requete api -->
        </div>
    </section>
</main>
</body>
</html>