<!doctype html>

<html lang="fr">
<?php include("template/header.html"); ?>

<body class="bg-light">

<?php include("template/navbar.html"); ?>
<div class="card text-center mx-auto bg-light mb-3" style="width: 1000px; margin-top:50px">
    <div class="card-header bg-info text-white">
        <h3>Inscription</h3>
    </div>
    <div class="card-body text-center"></div>
    <h3 class="sucessField alertField SuccessInscription" id="SuccessInscription">Bravo, votre inscription a bien été prise en compte !</h3>
    <h3 class="sucessField alertField SuccessInscription" id="SuccessInscription2">Un email de confirmation vient de vous êtres envoyé.</h3>
    <h6 class="sucessField alertField SuccessInscription">(redirection dans 5s...)</h6>

    <br>
    <form id="form_inscription" class="col-sm-12" method="POST" onsubmit="return false;">
        <div class="d-flex h-100">
            <div class="m-auto">
                <div class="form-group">
                    <label for="username_form" class="form-label">Username :</label>
                    <div class="input-group">
                        <input type="text" class="form-control inscription_input" name="username_form" id="username_form" placeholder="Username" maxlength="50" minlength="3">
                    </div>
                    <br>
                    <span class="alertField" id="alertUsername">Ce nom d'utilisateur est déjà utilisé</span>
                    <span class="alertField" id="alertUsername_length">Le nom d'utilisateur doit faire 3 caractères minimum</span>
                </div>

                <div class="form-group">
                    <label for="email_form" class="form-label">Email :</label>
                    <div class="input-group">
                        <input type="text" class="form-control inscription_input" id="email_form" name="email_form" placeholder="Entrez votre adresse email" maxlength="100" minlength="3">
                    </div>
                    <br>
                    <span class="alertField" id="alertMail">L'adresse email n'est pas valide</span><span class="alertField" id="alertMailUse">L'adresse email est déjà utilisée</span>
                </div>

                <div class="form-group">
                    <label for="password_form" class="form-label">Password :</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control inscription_input" id="password1" name="password_form" placeholder="Mot de passe" maxlength="50" minlength="6">
                    </div>
                    <br>
                    <span class="alertField" id="alertPassword_length">Le mot de passe doit faire 6 caractères minimum</span>
                </div>

                <div class="form-group">
                    <label for="password_verif" class="form-label">Password validation :</label>
                    <div class="input-group">
                        <input type="password" class="form-control inscription_input" id="password2" name="password_verif" placeholder="Vérification du mot de passe" maxlength="50" minlength="6">
                    </div>
                    <br>
                    <span class="alertField" id="alertPassword">Les mots de passe ne correspondent pas</span>
                </div>

                <div class="form-group">
                    <button id="btn_insctiption" class="btn btn-info text-white" onclick="send_inscription()">S'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</body>

</html>
