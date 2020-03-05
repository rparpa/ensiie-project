<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?= site_url('/htdocs/assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= site_url('/htdocs/assets/css/fontawesome.css') ?>">
        <link rel="stylesheet" href="<?= site_url('/htdocs/assets/css/style.css') ?>">
        <link rel="stylesheet" href="<?= site_url('/htdocs/assets/css/jquery-ui.min.css'); ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

        <script src="<?= site_url('/htdocs/assets/js/fontawesome.js') ?>"></script>

        <title><?= (isset($page_title) ? $page_title : 'Planning') ?></title>

        <script src="<?= site_url('/htdocs/assets/js/jquery.min.js') ?>"></script>
        <script src="<?= site_url('/htdocs/assets/js/jquery-ui.min.js') ?>"></script>
        <script src="<?= site_url('/htdocs/assets/js/popper.min.js') ?>"></script>
        <script src="<?= site_url('/htdocs/assets/js/bootstrap.min.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>


    </head>

    <body>

      <?php if ($this->auth->is_user()): ?>
        <?php $user_id=$this->auth->check_is_user(); ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= base_url('site/'); ?>">Planning</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('user/profil'); ?>">Profil</a>
            </li>
            <?php if (!$this->auth->is_orga()): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupe/liste'); ?>">Groupes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ami/liste'); ?>">Amis</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('event/main?f=1'); ?>">Evenements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('user/deconnexion') ?>">Deconnexion</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php endif; ?>

      <div class="container">

        <!-- MESSAGES D'ERREUR ET DE SUCCES -->
      	<div class="text-center">
              <?php if ($this->session->flashdata('error_message')): ?>
                  <div class="alert alert-danger"> <?= $this->session->flashdata('error_message') ?> </div>
              <?php endif; ?>
              <?php if ($this->session->flashdata('success_message')): ?>
                  <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
              <?php endif; ?>
                <?php echo validation_errors(); ?>
          </div>
