<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/main.css">
    <script src="static/js/display-nav.js"></script>
</head>
<body>
<main class="login-form-container">
    <div class="login-form-wrapper">
        <form class="login" action="form-data.php" method="post">
            <div class="login-form-header">
                <span> Connexion : </span>
            </div>
            <div class="login-form-body">
                <div class="login-form-item">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="login-form-item">
                    <input type="password" name="password" placeholder="Mot de passe">
                </div>
                Ne pas utiliser "\" dans vos identifiants.
            </div>
            <div class="pass"><a href="#">Forgot password?</a></div>
            <div class="login-form-item button-connexion">
                <input type="submit" value="Connexion">
            </div>
            <div class="form-login-footer">
                <div class="signup-link">Not a member ? <a href="#">Sign up now</a></div>
            </div>
        </form>
    </div>
</main>
</body>
</html>
