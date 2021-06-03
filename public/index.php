<!doctype html>

<html lang="fr">
<?php include("header.html"); ?>
<body>
<?php include("navbar.html"); ?>

        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">
                <a href="/index.html"><img class="icon-image" src="logo/logo.png" alt="logo.png"></a>
            </span>
            <nav class="mdl-navigation">
                <div class="separator"></div>
                <span class="mdl-navigation__link">Information Section</span>
                <a class="mdl-navigation__link" href="/">Accueil</a>
                <a class="mdl-navigation__link notUser" href="/inscription.html">inscription</a>
                <a class="mdl-navigation__link" href="a_propos.html">A propos</a>
                <div class="separator onlyUser"></div>
                <span class="mdl-navigation__link onlyUser">User Section</span>
                <a class="mdl-navigation__link onlyUser" href="/account.html">Account</a>
                <a class="mdl-navigation__link onlyUser" href="/deconnection.php">Deconnection</a>
                <div class="separator onlyAdmin"></div>
                <span class="mdl-navigation__link onlyAdmin">Section admin</span>
                <a class="mdl-navigation__link onlyAdmin" href="">Validation pages</a>
            </nav>
        </div>
        <div class="mdl-layout__content">
        </div>
    </div>
</body>
</html>
