
<?php include 'header.php';?>

<!-- Main -->
<div id="main">

<!-- connexion -->
<article id="connexion">
    <section>
        <h3 class="major">Connexion</h3>
        <form method="post" action="#">
            <div class="fields">
                <div class="field half">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" value="" placeholder="Snitchy" />
                </div>
                <div class="field half">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value="" placeholder="**********" autocomplete="off" />
                </div>
            </div>
            <ul class="actions">
                <li><input type="submit" value="Connexion" class="primary" /></li>

            </ul>
            <ul class="actions">
                <a class="primary" href="#CreerCompte">Créer un compte</a>
            </ul>

        </form>
    </section></article>

<?php include 'footer.php';?>