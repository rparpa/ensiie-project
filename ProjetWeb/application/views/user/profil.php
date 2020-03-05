<h1 class="title-style"><?= $page_title ?></h1>

<div class="card">
  <div class="card-header">
    <?= $user->prenom." ".$user->nom; ?>
  </div>
  <div class="card-body">
    <p>
    <?php if ($my_profil): ?>
      <a href="<?= base_url('user/modifier/'.$user->id) ?>" class="btn btn-dark">Modifier</a>
    <?php else: ?>
      <?php if ($est_ami): ?>
        <p> Vous êtes amis </p>
      <?php elseif ($est_demande): ?>
        <p> Demande en cours </p>
      <?php else: ?>
        <a href="<?= base_url('ami/ajouter/'.$user->id) ?>" class="btn btn-dark">Demander en ami</a>
      <?php endif; ?>
    <?php endif; ?>
  </p>
  </div>
</div>

<div>
  <?php if ($my_profil): ?>
    <div class="list-group" id="list-tab" role="tablist">
      <h3 style="margin-top:3%;">Mes centres d'intérêts</h3>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="tags" role="tabpanel" aria-labelledby="liste_tags">
        <!-- Si il y a 0 tags -->
        <?php if (empty($id_tags)): ?>
          <span></span>
          <h5>Vous n'avez pas encore de centres d'intérêt</h5>
        <!-- Si il y a 1+ tags -->
        <?php else: ?>
          <?php foreach($id_tags as $tag): ?>
            <span class="tag"> <?= $tag->nom; ?><a href="<?= base_url('tags/supprimer_user/'.$tag->id) ?>" style="color:#000000; padding:1%;"><i class="fas fa-times"></i></a></span>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <span class="col-md-10"></span>
    <div>
      <!-- Formulaire d'ajout de tags-->
      <?php echo form_open("tags/ajouter", array('class' => 'form-search', 'method' => 'POST')); ?>
        <div class="form-group">
          <select multiple class="selectpicker form-control" name="select_tags[]" id="tags" data-selected-text-format="count > 5" title="Choisissez 1 ou plusieurs tags">
            <?php foreach($tags as $tag): ?>
              <?php if ($tag->est_valide): ?>
                <option value="<?= $tag->id; ?>"><?= $tag->nom; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
            <button type="submit" id="envoyer-tags" class="btn btn-dark bouton_form ignore-leave-script">Ajouter</button>
        </div>
      <?php echo form_close(); ?>
    </div>
    <div>
      <?php echo form_open("tags/soumettre", array('class' => 'form-search', 'method' => 'POST')); ?>
        <div class="form-group">
          <input type="text" class="form-control" name="s" >

          <button type="submit" class="btn btn-dark bouton_form ignore-leave-script">Proposer un tag</button>
        </div>
      <?php echo form_close(); ?>
    </div>
  <?php endif; ?>
</div>
