<?php

require_once '../src/Bootstrap.php';
session_start();
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/main.css">
    <script src="static/js/display-nav.js"></script>

</head>
<body>
<main class="login-form-container">
    <div class="login-form-wrapper">
        <form class="login" action="form-data.php?login" method="post">
            <div class="login-form-header">
                <span class="connect-text"> Connexion : </span>
            </div>
            <div class="login-form-body">
                <div class="login-form-item">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="login-form-item">
                    <input type="password" name="password" placeholder="Mot de passe">
                </div>
            </div>
            <div class="pass"><a href="#">Mot de passe oublié ?</a></div>
            <div class="login-form-item button-connexion">
                <input type="submit" value="Connexion">
            </div>
            <div class="form-login-footer">
                <div class="signup-link">Pas encore membre ? <br> <a class="link" href="#">Inscrivez-vous !</a></div>
            </div>
        </form>
    </div>
</main>
</body>
</html>
