<div class="text-center">
    <?php
    	if (isset($msg) && $msg !== null){
    		for ($i=0; $i < count($msg); $i++) {
    			echo "<div class='alert'>". $msg[$i] ."</div>";
    			//echo "<div class='alert alert-danger'>". $msg[$i] ."</div>";
    		}
    	}
    ?>
</div>

<h1 class="title-style"><?= $page_title ?></h1>

<ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link <?php if (isset($active) && $active=="list") {echo "active";}?>" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">Vos &eacute;v&eacute;nements</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php if (isset($active) && $active=="search") {echo "active";}?>" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="true">Chercher un &eacute;v&eacute;nement</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php if (isset($active) && $active=="form") {echo "active";}?>" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="false">Cr&eacute;er un &eacute;v&eacute;nement</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
	<!-------- TAB : LISTE DES EVENEMENT --------->
	<div class="tab-pane fade <?php if (isset($active) && $active=="list") {echo "show active";}?>" id="list" role="tabpanel" aria-labelledby="list-tab">
		<h2 class="subtitle-style">&Eacute;v&eacute;nements organisés</h2>
      	<?php
      		if (!isset($events1) || empty($events1)) {
      			echo "<p>Aucun &eacute;v&eacute;nement cr&eacute;&eacute;</p>";
      		}
      	?>
  		<div class="row">
  			<div class="col-4">
  				<div class="list-group" id="list-tab" role="tablist">
					<?php
						if (isset($events1) && !empty($events1)){

							foreach($events1 as $event): 
								echo "<a class='list-group-item list-group-item-action' id='list-$event->id-list' data-toggle='list' href='#list-$event->id' role='tab' aria-controls='$event->id'>$event->titre - (";
								if (empty($id_tags[$event->id])):
									echo "Aucun tags";
								else:
									foreach($id_tags[$event->id] as $key => $tag):
										echo $tag->nom;
										if ($key != count($id_tags[$event->id])-1) echo ", ";
									endforeach;
								endif;
								echo ")</a>";
			      			endforeach;
			      		}
			      	?>
  				</div>
  			</div>
  			<div class="col-8">
			    <div class="tab-content" id="nav-tabContent">
			    	<?php
					
						if (isset($events1) && !empty($events1)){
							foreach($events1 as $event):
					?>
								<div class='tab-pane fade' id='list-<?=$event->id?>' role='tabpanel' aria-labelledby='list-<?=$event->id?>-list'>
										<?php if (isset($event->img_url) && $event->img_url != null) { ?>
											<img src="<?=site_url($event->img_url);?>" alt="Banière de <?=$event->titre?>" class="img-thumbnail little">
										<?php } ?>
										<?=$event->description?>
										<hr>
										<div class='btn-group' role='group' aria-label='Basic example'>
										  <a type='button' class='btn btn-secondary' href="<?= base_url('event/edit/'.$event->id) ?>">Modifier</a>
										  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?= $event->id ?>">Supprimer</button>
										</div>
								</div>
							    <!-- Modal -->
								<div class="modal fade" id="<?= $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Suppression de l'événement "<?= $event->titre ?>"</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Cet &eacute;v&eacute;nement sera retir&eacute; de la liste des &eacute;v&eacute;nements de chaque participant.
												Etes-vous sur de vouloir supprimer cet &eacute;v&eacute;nement ?
											</div>
											<div class="modal-footer">
												<a type='button' class='btn btn-danger' href="<?= base_url('event/delete/'.$event->id) ?>">Valider</a>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
											</div>
										</div>
									</div>
								</div>
					<?php
			      			endforeach;
			      		}
			      	?>
			    </div>
			 </div>
		</div>
		<br>

		<h2 class="subtitle-style">&Eacute;v&eacute;nements ajout&eacute;s</h2>
		<?php
      		if (!isset($events2) || empty($events2)) {
      			echo "<p>Vous ne participez &agrave; aucun &eacute;v&eacute;nement</p>";
      		}
      	?>
  		<div class="row">
  			<div class="col-4">
  				<div class="list-group" id="list-tab" role="tablist">
					<?php
						if (isset($events2) && !empty($events2)){
			      			foreach($events2 as $event): 
								echo "<a class='list-group-item list-group-item-action' id='list-$event->id-list' data-toggle='list' href='#list-$event->id' role='tab' aria-controls='$event->id'>$event->titre - (";
								if (empty($id_tags[$event->id])):
									echo "Aucun tags";
								else:
									foreach($id_tags[$event->id] as $key => $tag):
										echo $tag->nom;
										if ($key != count($id_tags[$event->id])-1) echo ", ";
									endforeach;
								endif;
								echo ")</a>";
			      			endforeach;
			      		}
			      	?>
  				</div>
  			</div>
  			<div class="col-8">
			    <div class="tab-content" id="nav-tabContent">
			      	<?php
						if (isset($events2) && !empty($events2)){
							foreach($events2 as $event):
					?>
								<div class='tab-pane fade' id='list-<?=$event->id?>' role='tabpanel' aria-labelledby='list-<?=$event->id?>-list'>
										<?=$event->description?>
										<hr>
										<div class='btn-group' role='group' aria-label='Basic example'>
										  <a type='button' class='btn btn-secondary' href="<?= base_url('event/details/'.$event->id) ?>">D&eacute;tails</a>
										  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?= $event->id ?>">Retirer</button>
										</div>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="<?= $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Suppression de l'événement "<?= $event->titre ?>"</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Cet &eacute;v&eacute;nement sera retir&eacute; de votre liste des &eacute;v&eacute;nements.
												Etes-vous sur de vouloir supprimer cet &eacute;v&eacute;nement ?
											</div>
											<div class="modal-footer">
												<a type='button' class='btn btn-danger' href="<?= base_url('event/delete/'.$event->id) ?>">Valider</a>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
											</div>
										</div>
									</div>
								</div>
					<?php
			      			endforeach;
			      		}
			      	?>
			    </div>
			 </div>
		</div>
    </div>
    <!-------- TAB : BARRE DE RECHERCHE D'EVENT --------->
	<div class="tab-pane fade <?php if (isset($active) && $active=="search") {echo "show active";}?>" id="search" role="tabpanel" aria-labelledby="search-tab">
		<br>
		<?php echo form_open("event/rechercher", array('class' => 'form-search', 'method' => 'GET')); ?>
			<div class="form-group">
				<label for="type">Type d'&eacute;v&eacute;nement</label>
				<input type="text" id="type" class="form-control" name="s" >
			</div>
			<div class="form-group">
				<label for="tag">Tags de l'&eacute;v&eacute;nement</label>
				<input type="text" id="tag" class="form-control" name="t">
			</div>
			<div class="form-group">
				<label for="region">R&eacute;gion</label>
				<input type="text" id="region" class="form-control" name="r" disabled="disabled">
			</div>
			<div class="form-group">
				<button type="submit">Rechercher</button>
			</div>
		<?php echo form_close(); ?>

		<?php
      		if (isset($events_found) && empty($events_found)) {
      			echo "<p>Aucun evenement trouvé</p>";
      		}
      	?>
  		<div class="row">
  			<div class="col-4">
  				<div class="list-group" id="list-tab" role="tablist">
					<?php
						if (isset($events_found) && !empty($events_found)){
			      			foreach($events_found as $event): 
								echo "<a class='list-group-item list-group-item-action' id='list-$event->id-list' data-toggle='list' href='#list-$event->id' role='tab' aria-controls='$event->id'>$event->titre</a>";
			      			endforeach;
			      		}
			      	?>
  				</div>
  			</div>
  			<div class="col-8">
			    <div class="tab-content" id="nav-tabContent">
			      	<?php
						if (isset($events_found) && !empty($events_found)){
							foreach($events_found as $event):
					?>
								<div class='tab-pane fade' id='list-<?=$event->id?>' role='tabpanel' aria-labelledby='list-<?=$event->id?>-list'>
										<?=$event->description?>
										<div class='btn-group' role='group' aria-label='Basic example'>
										  <a type='button' class='btn btn-secondary' href="<?= base_url('event/details/'.$event->id) ?>">D&eacute;tails</a>
										  <a type='button' class='btn btn-success' href="<?= base_url('event/ajouter/'.$event->id) ?>">Particip&eacute;</a>
										</div>
										<hr>
								</div>
					<?php
			      			endforeach;
			      		}
			      	?>
			    </div>
			 </div>
		</div>
		<hr>
		<?php echo form_open("event/rechercher/quick", array('class' => 'form-search', 'method' => 'GET')); ?>
			<div class="form-group">
				<button type="submit">Rechercher rapide</button>
				<span><i> - recherche selon vos centres d'intérets</i></span>
			</div>
		<?php echo form_close(); ?>
		<hr>
	</div>
    <!-------- TAB : FORMULAIRE DE CREATION D'EVENT --------->
	<div class="tab-pane fade <?php if (isset($active) && $active=="form") {echo "show active";}?>" id="form" role="tabpanel" aria-labelledby="form-tab">
		<!-- Formulaire pour ajouter ou modifier un evenement ------------------------------>
		<?php echo form_open("event/main", array('enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
		<br>
		<!--- Section input/label -> infos générales ------------------------------>
		<div class="form-group">
			<label for="titre">Titre*</label>
			<input type="text" class="form-control" name="titre" id="titre">
		</div>

		<div class="form-group">
			<label for="description">Description*</label>
			<textarea class="form-control" name="description" id="description" rows="3"></textarea>
		</div>

		<div class="form-group">
			<label for="tags">Tags*</label>
			<select multiple class="selectpicker form-control" name="tags[]" id="tags" data-selected-text-format="count > 5" title="Choisissez 1 ou plusieurs tags">
				<?php foreach($tags as $tag): ?>
					<?php if ($tag->est_valide): ?>
						<option value="<?= $tag->id; ?>"><?= $tag->nom; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php if (!$user->is_organisateur): ?>
	      <div class="form-group">
	          <div class="form-check">
	              <input class="form-check-input" name="est_publique" type="checkbox" id="est_publique">
	              <label class="form-check-label" for="est_publique">
	                  Evénement publique ?
	              </label>
	          </div>
	      </div>
	  	<?php endif; ?>
		<div class="form-group">
			<label for="img_url">Banni&egrave;re de l'&eacute;v&eacute;nement</label>
			<input type="file" class="form-control-file" name="img_url" id="img_url">
		</div>

		<!--- Section période -> sélection des dates ------------------------------>
		<div class="form-row">
			<div class="col">
				<label for="date_debut">Date de d&eacute;but*</label>
				<input type="date" class="form-control" name="date_debut" id="date_debut">
			</div>
			<div class="col">
				<label for="date_fin">Date de fin*</label>
				<input type="date" class="form-control" name="date_fin" id="date_fin">
			</div>
		</div>

		<!--- Section géolocalisation -> api google ------------------------------>
		<hr>
		<div class="form-row">
			<div class="col">
				<label for="latitude">Latitude</label>
				<input type="text" class="form-control" name="latitude" id="latitude">
			</div>
			<div class="col">
				<label for="longitude">Longitude</label>
				<input type="text" class="form-control" name="longitude" id="longitude">
			</div>
		</div>

		<br>
		<div class="form-group">
			<button type="submit" id="valider" class="btn btn-dark btn-lg btn-block">VALIDER</button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>
