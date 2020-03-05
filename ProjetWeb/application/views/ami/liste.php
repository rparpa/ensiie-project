<h1 class="title-style"><?= $page_title ?></h1>


<?php echo form_open("user/rechercher", array('class' => 'form-search', 'method' => 'GET')); ?>
  <div class="form-group">
      <div class="input-group" id="" data-target-input="nearest">
      <input type="text" class="form-control" name="s" >
        <div class="input-group-append">
              <button type="submit" class="btn-sm btn-dark" id="rechercher" >Rechercher</button>
        </div>
      </div>
    </div>
<?php echo form_close(); ?>

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="liste_amis" data-toggle="list" href="#amis" role="tab" aria-controls="amis">Vos amis</a>
      <a class="list-group-item list-group-item-action" id="liste_demandes" data-toggle="list" href="#demandes" role="tab" aria-controls="demandes">Demandes d'amis</a>
      <a class="list-group-item list-group-item-action" id="ajouter_groupe" href="" role="tab">Nouveau groupe</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="amis" role="tabpanel" aria-labelledby="liste_amis">
      	<h2>Liste de vos amis</h2>
      	<?php foreach($amis as $ami): ?>
      		<div class="row">
            <div class="col-2">
              <a href="<?= base_url('user/profil/'.$ami->id) ?>"><?= $ami->login; ?></a>
            </div>
            <div class="col-2">
              <?= $ami->prenom.' '.$ami->nom; ?>
            </div>
            <hr></hr>
          </div>
      	<?php endforeach; ?>
      </div>
      <div class="tab-pane fade" id="demandes" role="tabpanel" aria-labelledby="liste_demandes">
      	<h2>Demandes d'amis</h2>
      	<?php foreach($demandes_ami as $demande): ?>
      		<div>
      			<?= $demande->login; ?>
      			<a href="<?= base_url('ami/reponse/'.$demande->id.'/1') ?>" class="btn btn-succes">Accepter</a>
      			<a href="<?= base_url('ami/reponse/'.$demande->id.'/0') ?>" class="btn btn-danger">Refuser</a>
      		</div>
      	<?php endforeach; ?>
      </div>
    </div>
  </div>
</div>