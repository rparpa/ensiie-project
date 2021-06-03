<!doctype html>

<html lang="fr">
<?php include("header.html"); ?>
<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <div class="mdl-layout__header mdl-layout__header--waterfall">
            <div class="mdl-layout__header-row">
                <span>
                    <a href="/index.html"><span id="title_Wikipediie">Wikiped<span style="color: #4998a7">IIE</span></span></a>
                </span>
                <div class="mdl-layout-spacer"></div>

                <form id="connection_form">
                    <nav class="mdl-navigation">
                        <span id="affiche_name" class="onlyUser"></span>
                        <input placeholder="Username" class="mdl-textfield__input connection_input notUser" type="text" id="username">
                        <input placeholder="Password" class="mdl-textfield__input connection_input notUser" type="password" id="password">
                    </nav>
                </form>
                <button style="background-color: #424242;" onclick="verify_user();" class="mdl-button mdl-js- mdl-button--raised mdl-js-ripple-effect mdl-button--accent notUser" id="connection_btn">Connexion</button>

                <button style="background-color: #424242;" onclick="add_new_article()" class="mdl-button mdl-js- mdl-button--raised mdl-js-ripple-effect mdl-button--accent onlyUser" id="new_article_btn">Ajouter un article</button>
                <button style="background-color: #424242;" onclick="deconnection()" class="mdl-button mdl-js- mdl-button--raised mdl-js-ripple-effect mdl-button--accent onlyUser" id="deconnection_btn">Deconnexion</button>

            </div>
        </div>

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
