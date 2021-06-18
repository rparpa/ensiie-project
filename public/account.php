<!doctype html>

<html lang="fr">
<?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html"); ?>
    <div class="card text-center mx-auto bg-light mb-3" style="width: 1000px; margin-top:50px">
        <div class="card-header bg-info text-white">
            <h3>Mon profil utilisateur</h3>
        </div>
        <div class="card-body text-center">
            <br>
            <form id="form_account" class="col-sm-12" method="POST" onsubmit="return false;">
                <div class="d-flex h-100">
                    <div class="m-auto">
                        <h3 class="text-info"> Informations personnelles</h3>
                        <br>
                        <div class="form-group info">
                            <div>
                                <h7 class="col-sm-2"> <b> Nom d'utilisateur : </b></h7>
                                <span class="col-sm-10" id="account_username">ERROR</span>
                            </div>
                            <div>
                                <h7 class="col-sm-2"> <b> Email : </b></h7>
                                <span class="col-sm-10" id="account_email">ERROR</span>
                            </div>
                            <br>
                            <br>
                            <div class="form-group" id="div_inscription">
                                <button id="btn_remove_account" class="btn btn-info text-white" onclick="deleteAccount()">Supprimer mon compte</button>
                            </div>
                            <br>
                            <br>
                        </div>
                        <h3 class="text-info"> Changer mon mot de passe</h3>
                        <br>
                        <div class="form-group">
                            <label class="form-label">Mot de passe actuel :</label>
                            <div class="input-group">
                                <input type="password" class="form-control passwd_input" type="password" id="currentPassword" name="currentPassword" placeholder="Mot de passe actuel" maxlength="50" minlength="6">
                            </div>
                            <br>
                            <span class="alertField" id="alertCurrentPassword">Mot de passe incorrect</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nouveau mot de passe :</label>
                            <div class="input-group">
                                <input type="password" class="form-control passwd_input" type="password" id="passwordAccount" name="passwordAccount" placeholder="Nouveau mot de passe" maxlength="50" minlength="6">
                            </div>
                            <br>
                            <span class="alertField" id="alertPassword_length">Le mot de passe doit faire 6 caractères minimum<br></span>
                            <span class="alertField" id="alertSamePassword">Le nouveau mot de passe est identique à l'ancien</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmation du nouveau mot de passe :</label>
                            <div class="input-group">
                                <input type="password" class="form-control passwd_input" type="password" id="passwordAccountVerif" name="passwordAccountVerif" placeholder="Confirmation du nouveau mot de passe" maxlength="50" minlength="6">
                            </div>
                            <br>
                            <span class="alertField" id="alertPassword">Les mots de passe ne correspondent pas<br></span>
                            <span class="alertField sucessField" id="SucessPassword">Votre mot de passe a été changé avec succes !</span>
                        </div>
                        <div class="form-group" id="div_inscription">
                            <button id="btn_changePassword" class="btn btn-info text-white" onclick="sendNewPassword()">Changer mon mot de passe</button>
                        </div>
                        <br>
                        <br>
                        <h3 class="text-info"> Changer mon adresse email</h3>
                        <br>
                        <div class="form-group">
                            <label class="form-label">Email :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" type="text" id="emailAccount" name="emailAccount" placeholder="Nouvelle adresse email" maxlength="50" minlength="3">
                            </div>
                            <br>
                            <span class="alertField" id="alertMail">L'adresse email n'est pas valide</span><span class="alertField" id="alertMailUse">L'adresse email est déjà utilisée</span>
                            <span class="alertField sucessField" id="sucessEmail">Votre adresse email a été changé avec succes !<br></span>
                        </div>
                        <div class="form-group" id="div_inscription">
                            <button class="btn btn-info text-white" onclick="sendNewEmail()">Changer mon adresse email</button>
                        </div>
                        <div id="divModo" class="form-group">
                            <br>
                            <h3 class="text-info">Demander à devenir Moderateur</h3>
                            <br>
                            <label for="modo_form" class="form-label">Message :</label>
                            <div class="input-group">
                                <textarea class="form-control"  rows="4" id="msgModo" name="msgModo" maxlength="200"></textarea>
                            </div>
                            <br>
                            <span class="alertField sucessField" id="sucessDemandeModo">Votre demande pour devenir moderateur a bien été prise en compte !<br><br></span>
                            <div class="form-group" id="div_inscription">
                                <button class="btn btn-info text-white" onclick="demandeModo()">Envoyer ma demande</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    <script>
    affichageInfoUser();
    if(checkModo() || localStorage.getItem('isadmin') == "true"){
        $("#divModo").hide();
    }
    </script>
</body>

</html>