<h1 class="title-style"><?= $page_title ?></h1>

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="liste_groupes" data-toggle="list" href="#amis" role="tab" aria-controls="amis">Vos groupes</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="groupes" role="tabpanel" aria-labelledby="liste_groupes">
      	<h2>Liste de vos groupes</h2>
      	<?php foreach($groupes as $groupe): ?>
      		<div>
      			<?= $groupe->nom; ?>
      		</div>
      	<?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
