<h1>Bonjour <?= $user->prenom.' '.$user->nom ?></h1>
<p>
    Cliquez sur ce lien pour valider votre compte : <a href="<?= base_url('user/valider_compte/'.$user->hash) ?>">ici</a><br><br>
    Cordialement, <b><br>
        </p>
