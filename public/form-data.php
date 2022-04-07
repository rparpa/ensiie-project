<?php

echo '<html lang="fr">
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>
</html>';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);
    $password_hashed = hash("sha256", $password, true);
    echo utf8_encode($password_hashed);
}
else {
 echo "Redirection vers page formulaire  - erreur";
}
