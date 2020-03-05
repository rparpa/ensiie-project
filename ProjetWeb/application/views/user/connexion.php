<h1 class="title-style"><?= $page_title ?></h1>

<?php echo form_open(); ?>
<label for="email">Login/Email</label>
<div class="row">
    <div class="col-sm-7 col-md-5">
        <div class="form-group">
            <div class="input-group mb-2">
                <!---------------- FlashData correspond au cas ou l'user a saisi un email dans le footer pour la newsletter --------------------->
                <input type="text" class="form-control" name="login" id="login" value="<?= $this->session->flashdata('email_newsletter') ? $this->session->flashdata('email_newsletter') : set_value('email') ?>"><br>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="password">Mot de passe</label>
    <div class="form-row">
        <div class="col-sm-7 col-md-5">
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password">
            </div>
        </div>
        <div class="col-sm-5 col-md-7 text-sm-right">
            <div class="form-group">
                <button type="submit" id="envoyer-ignore" class="btn btn-dark bouton_form ignore-leave-script">Me connecter</button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<a href="<?= base_url('user/inscription'); ?>">Inscription</a>