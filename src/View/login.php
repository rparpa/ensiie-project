<form class="formulaire" action="authenticate.php" method="post">
    <div class="container-fluid">
        <div class="form-row" align="center">
            <legend>Login</legend>
        </div>
        <div class="form-row">
                <label class="label-lenght-fix" for="email">Email : </label>
                <input type="text" name="email" id="email" required>
                <span class="error" aria-live="polite" id="errormail"></span>
        </div>
        <div class="form-row">
                <label class="label-lenght-fix" for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" required>
                <span class="error" aria-live="polite" id="errorpassword"></span>
        </div>
        <div class="form-row">
                <button type="submit">Valider</button>
        </div>
        <div class="form-row">
            <?php if (isset($data['failedAuthent'])): ?>
                <span class="error-message"><?= $data['failedAuthent'] ?></span>
            <?php endif; ?>
        </div>
    </div>
</form>
