<?php
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/main.css">
    <script src="static/js/display-nav.js"></script>
</head>
<body>
<main class="signup-form-container">
    <div class="signup-form-wrapper">
        <form class="signup" action="form-data.php?signup" method="post">
            <div class="signup-form-header">
                <span class="signup-text"> Inscription : </span>
            </div>
            <div class="signup-form-body">
                <div class="signup-form-item nom">
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="signup-form-item prenom">
                    <input type="text" name="prenom" placeholder="Prenom" required>
                </div>
                <div class="signup-form-item pseudo">
                    <input type="text" name="pseudo" placeholder="Pseudo" required>
                </div>
                <div class="signup-form-item email">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="signup-form-item password">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="signup-form-item-file input image-input photo-de-profil">
                    <label class="label-image-sign-up" for="file">Photo de Profil :</label>
                    <span class="error hidden" id="error-photo-sign-up">Vous devez insérer une photo</span>
                    <input type="file" accept="image/*" name="photo-de-profil" id="imgInputSignUp" class="hidden"/>
                    <input type="button" value="Parcourir"
                           onclick="document.getElementById('imgInputSignUp').click();"/>
                    <img id="resultImgSignUp" class="hidden" src="#" alt="your image"/>
                </div>
                <div class="signup-form-item adresse">
                    <input type="text" name="adresse" placeholder="Adresse" required>
                </div>
                <div class="signup-form-item code-postal">
                    <input type="number" name="code-postal" placeholder="Code Postal" required>
                </div>
                <div class="signup-form-item ville">
                    <input type="text" name="ville" placeholder="Nom de la ville" required>
                </div>
            </div>
            <div class="signup-form-item button-inscription">
                <input type="submit" value="Inscription">
            </div>
            <div class="error-login hidden">
                <?php
                if (isset($_GET['alreadyExists'])) {
                    echo "<script src='./static/js/login.js'></script>";
                    echo "Votre email a déjà été inscrite !";
                }
                ?>
            </div>
            <div class="form-signup-footer">
                <div class="connect-link">Déjà membre ? <br> <a class="link" href="index.php">Connectez-vous !</a></div>
            </div>
        </form>
    </div>
</main>
</body>
</html>
