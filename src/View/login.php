<form action="authenticate.php" method="post" onsubmit="return verif()">
    <div class="formulaire">
        <div align="center">
            <label for="email">
                <div>
                    <span>Email :</span>
                </div>
                <input type="text" name="email" id="email"/>
                <div>
                    <span class="error" aria-live="polite" id="errormail"></span>
                </div>
            </label>
        </div>
        <div align="center">
            <label for="password">
                <div>
                    <span>Mot de passe :</span>
                </div>
                <input type="password" name="password" id="password"/>
                <div>
                    <span class="error" aria-live="polite" id="errorpassword"></span>
                    <?php if (isset($data['failedAuthent'])): ?>
                        <span class="error-message"><?= $data['failedAuthent'] ?></span>
                    <?php endif; ?>
                </div>
            </label>
        </div>
        <div align="center">
            <button type="submit">Valider</button>
        </div>
    </div>
</form>


<script>
    function verif() {
        var valide = true;
        var email = document.getElementById('email');
        var password = document.getElementById('password');

        var valide = true;
        if (!email.validity.valid || email.value === '') {
            document.getElementById('errormail').innerHTML = "L'adresse e-mail n'est pas valide";
            valide &= false;
        } else {
            document.getElementById('errormail').innerHTML = ""; // On réinitialise le contenu
        }
        if (password.value==='') {
            document.getElementById('errorpassword').innerHTML = "Le mot de passe n'est pas renseigné !";
            valide &= false;
        }
        else{
            document.getElementById('errorpassword').innerHTML = ""; // On réinitialise le contenu
        }


        return valide==1;
    }
</script>
