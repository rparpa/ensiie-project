
<h1 class="title-style"><?= $page_title ?></h1>

<!-- Formulaire pour ajouter ou modifier un utilisateur ------------------------------>
<?php echo form_open(); ?>

  <!--- Section input/label -> infos générales ------------------------------>

  <div class="form-group">
      <label for="login">Login</label>
      <input type="text" class="form-control" name="login" id="login" value="<?= set_value('login', @$user->login) ?>">
  </div>


  <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email', @$user->email) ?>">
  </div>

  <!--- Dispo à l'inscription ------------------------------>
  <?php if (!isset($user)): ?>
      <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" class="form-control" name="password" id="nom" >
      </div>

      <div class="form-group">
          <label for="confirm">Confirmation du mot de passe</label>
          <input type="password" class="form-control" name="confirm" id="nom" >
      </div>
  <?php endif; ?>

  <div class="form-group">
      <div class="form-check">
        <?php if (!isset($user)): ?>
          <input class="form-check-input" name="organisateur" type="checkbox" id="organisateur" value="1" >
        <?php else: ?>
          <input class="form-check-input" name="organisateur" type="checkbox" id="organisateur" value="1" <?php echo ($user->is_organisateur==1 ? 'checked' : '');?>>
        <?php endif; ?>
          <label class="form-check-label" for="organisateur">
              Êtes-vous un compte organisateur d'évènement(s) ?
          </label>
      </div>
  </div>

  <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" name="nom" id="nom" value="<?= set_value('nom', @$user->nom) ?>">
  </div>

  <div class="form-group">
      <label for="nom">Prénom</label>
      <input type="text" class="form-control" name="prenom" id="prenom" value="<?= set_value('prenom', @$user->prenom) ?>">
  </div>

  <div class="form-group">
      <label for="date_naissance">Date de naissance</label>
      <input type="text" class="form-control" name="date_naissance" id="date_naissance" value="<?= set_value('date_naissance', @$user->date_naissance) ?>">
  </div>


  <!--- Obligation de cocher la politique de confdentialité avant de s'inscrire ------------------------------>
  <?php if (!isset($user)): ?>
      <div class="form-group">
          <div class="form-check">
              <input class="form-check-input" name="politique" type="checkbox" id="politique" required="true">
              <label class="form-check-label" for="politique">
                  J'ai lu et accepté la politique de données personnelles.
              </label>
          </div>
      </div>
  <?php endif; ?>

  <div class="form-group">
      <button type="submit" id="envoyer" class="btn btn-dark btn-lg btn-block">VALIDER</button>
  </div>

<?php echo form_close(); ?>

<?php if (!isset($user)): ?>
  <a href="<?= base_url('user/connexion'); ?>">Connexion</a>
<?php endif; ?>
