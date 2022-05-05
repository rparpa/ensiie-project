<?php
require_once '../vendor/autoload.php';
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/main.css">
</head>
<body>
<main class="login-form-container">
    <div class="login-form-wrapper">
        <form class="login" action="actions/auth-validator.php?login" method="post">
            <div class="login-form-header">
                <span class="connect-text"> Connexion : </span>
            </div>
            <div class="login-form-body">
                <div class="login-form-item">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="login-form-item last-item">
                    <input id="login-input-password" type="password" name="password" placeholder="Mot de passe"
                           minlength="1" required>
                </div>
            </div>
            <div class="error-login hidden">
                <?php
                if (isset($_GET['unknownUser'])) {
                    echo "<script src='static/js/pages/index.js'></script>";
                    echo "Vous n'êtes pas inscrit !";
                }
                ?>
            </div>
            <div class="pass"><a href="#">Mot de passe oublié ?</a></div>
            <div class="login-form-item button-connexion">
                <input type="submit" value="Connexion">
            </div>
            <div class="form-login-footer">
                <div class="signup-link">Pas encore membre ? <br> <a class="link" href="sign-up-form.php">Inscrivez-vous
                        !</a></div>
            </div>
        </form>
    </div>
</main>
</body>
</html>
