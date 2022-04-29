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
    <section class="user-profile-container">
        <div class="user-profile-header">
            <div class="user-profile-page-title">
                <h2>Profil utilisateur :</h2>
            </div>
            <div class="user-profile-image">
                <img src="../static/assets/zoro.jpg" class="photo"/>
            </div>
            <div class="user-profile-header-email">
                <h4>Email :</h4>
                leurhackerdu92enfinjepensequejepasseaprès@gmail.com
            </div>
            <div class="user-profile-header-username">
                <h4>Pseudo :</h4>
                MichelDu92140
            </div>
        </div>
        <div class="user-profile-infos">
            <div class="user-profile-identite">
                <div class="user-profile-infos-header">
                    <h4>Identité :</h4>
                </div>
                <div class="user-profile-infos-identite">
                    <div class="all-user-item-info user-item-firstname">
                        <p> Prénom : Jonathan </p>
                    </div>
                    <div class="all-user-item-info user-item-lastname">
                        <p> Nom : Jusseaume </p>
                    </div>
                </div>
            </div>
            <div class="user-profile-location">
                <div class="user-profile-infos-header">
                    <h4>Localisation :</h4>
                </div>
                <div class="user-profile-street">
                    <p>Adresse : 15 rue de la ciudad de champagne</p>
                </div>
                <div class="user-profile-infos-location">
                    <div class="user-item-city">
                        <p>Ville : Champigny-sur-Marne</p>
                    </div>
                    <div class="user-item-zipcode">
                        <p> Code Postal : 920000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-profile-button-ban">Bannir</div> <!-- Ne pas oublier de faire le bouton "débannir-->
        <!-- requete api -->
    </section>
</main>
</body>
</html>