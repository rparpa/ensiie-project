<!doctype html>

<html lang="fr">
<?php include("header.html"); ?>
<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <div class="mdl-layout__header mdl-layout__header--waterfall">
            <div class="mdl-layout__header-row">
                <span>
                    <a href="/index.html" id="title_Wikipediie">Wikiped<span style="color: #4998a7">IIE</span></a>
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
            <div class=" mdl-grid" id="top">
                <div class="mdl-cell--12-col"><h2 style="text-align: center;">Votre profile utilisateur</h2></div>
                <div class="mdl-grid section_account" id='div_inscription'>

                    
                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--12-col">&nbsp;</div>

                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--6-col"><h4>Informations personnelles</h4></div>
                    <div class="mdl-cell--3-col"></div>
                    
                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--6-col"><h5>Nom d'utilisateur : <span id="account_username">Test</span></h5></div>
                    <div class="mdl-cell--3-col"></div>
                    
                    
                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--6-col"><h5>Email : <span id="account_email">Test@gmail.com</span></h5></div>
                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--12-col">&nbsp;</div>
                </div>
                <div class="mdl-cell--12-col">&nbsp;</div>
                <div class="mdl-grid section_account" id="form_account">

                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--6-col"><h5><h4>Changer votre mot de passe</h4></div>
                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--12-col">&nbsp;</div>

                    <div class="mdl-cell--3-col"></div>
                    <div class="mdl-cell--2-col">Mot de passe actuel<span>*</span> :</div>
                    <div class="mdl-cell--3-col">
                        <input class="mdl-textfield__input passwd_input" type="password" id="currentPassword" name="currentPassword" placeholder="Mot de passe actuelle" maxlength="50" minlength="6"></div>
                    <div class="mdl-cell--4-col"></div>

                    <div class="mdl-cell--12-col">&nbsp;<span class="alertField" id="alertCurrentPassword">Mot de passe incorrect</span></div>

                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--3-col"></div><div class="mdl-cell--2-col">
                        Nouveau mot de passe<span>*</span> :</div>
                        <div class="mdl-cell--3-col">
                        <input class="mdl-textfield__input passwd_input" type="password" id="passwordAccount" name="passwordAccount" placeholder="Nouveau mot de passe" maxlength="50" minlength="6"></div>
                        <div class="mdl-cell--4-col"></div>
                    
                    
                        <div class="mdl-cell--12-col">&nbsp;<span class="alertField" id="alertPassword_length">Le mot de passe doit faire 6 caractères minimum</span></div>

                    <div class="mdl-cell--12-col">&nbsp;</div>
                    <div class="mdl-cell--3-col"></div><div class="mdl-cell--2-col">
                        Vérification du nouveau mot de passe<span>*</span> :</div>
                        
                        <div class="mdl-cell--3-col">
                                <input class="mdl-textfield__input passwd_input" type="password" id="passwordAccountVerif" name="passwordAccountVerif" placeholder="Vérification du nouveau mot de passe" maxlength="50" minlength="6"></div>
                        <div class="mdl-cell--4-col"></div>
                    
                        <div class="mdl-cell--12-col">&nbsp;<span class="alertField" id="alertPassword">Les mots de passe ne correspondent pas</span></div>

                   <div class="mdl-cell--12-col" id="div_inscription">
                        <button id="btn_change_password" onclick="change_password()" class="mdl-button mdl-js- mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn_insctiption">Changer mon mot de passe</button>
                    </div>
                    <div class="mdl-cell--12-col">&nbsp;<span class="alertField" id="SucessPassword">Les mots a été changé avec succes !</span></div>

                </div>

                


            </div>
        </div>
    </div>
</body>
</html>
