<div class="text-center">
    <?php
    	if (isset($msg) && $msg !== null){
    		for ($i=0; $i < count($msg); $i++) {
    			echo "<div class='alert'>". $msg[$i] ."</div>";
    		}
    	}
    ?>
</div>

<h1 class="title-style"><?= $page_title ?></h1>

<ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">Modification</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
    <!-------- TAB : FORMULAIRE D'EDITION D'EVENT --------->
	<div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="edit-tab">
		<!-- Formulaire pour ajouter ou modifier un evenement ------------------------------>
		<?php echo form_open("event/edit/".$event->id, array('enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
		<div class="form-group" style="display:none;">
			<input type="text" class="form-control" id="event_id" name="event_id" value ="<?= set_value('event_id', @$event->id) ?>">
		</div>
		<br>
		<!--- Section input/label -> infos générales ------------------------------>
		<div class="form-group">
			<label for="titre">Titre*</label>
			<input type="text" class="form-control" name="titre" id="titre" value="<?= set_value('titre', @$event->titre) ?>">
		</div>

		<div class="form-group">
			<label for="description">Description*</label>
			<textarea class="form-control" name="description" id="description" rows="3" ><?= set_value('description', @$event->description) ?></textarea>
		</div>

		<div class="form-group">
			<label for="tags">Tags*</label>
			<!-- Si il y a 0 tags -->
			<?php if (empty($id_tags)): ?>
				<span></span>
				<p>Votre event n'a pas encore de tags.</p>
			<!-- Si il y a 1+ tags -->
			<?php else: ?>
				<?php foreach($id_tags as $tag): ?>
					<span class="tag"> <?= $tag->nom; ?><a href="<?= base_url('event/supprimer_tag/'.$tag->id."/".$event->id) ?>" style="color:#000000; padding:1%;"><i class="fas fa-times"></i></a></span>
				<?php endforeach; ?>
			<?php endif; ?>
			<select multiple class="selectpicker form-control" name="tags[]" id="tags" data-selected-text-format="count > 5" title="Choisissez 1 ou plusieurs tags">
				<?php
					foreach ($tags as $tag) {
						if ($tag->est_valide){
							echo "<option value='".$tag->id."'";
							foreach ($id_tags as $selected_tag) {
								if ($tag->id == $selected_tag->id){
									echo "selected";
									break;
								}
							}
							echo ">".$tag->nom."</option>";
						} 
					}
				?>
			</select>
		</div>


		<div class="form-group">

		  <label for="img_url">Banni&egrave;re de l'&eacute;v&eacute;nement</label>
		  <input type="file" class="form-control-file" name="img_url" id="img_url">
		  <?php if (isset($event->img_url) && $event->img_url != null) { ?>
		    <img src="<?=site_url($event->img_url);?>" alt="Banière de <?=$event->titre?>" class="img-thumbnail little">
		  <?php } ?>
  	</div>

		<!--- Section période -> sélection des dates ------------------------------>
		<div class="form-row">
			<div class="col">
				<label for="date_debut">Date de d&eacute;but*</label>
				<input type="date" class="form-control" name="date_debut" id="date_debut" value="<?= set_value('date_debut', @$event->date_debut) ?>">
			</div>
			<div class="col">
				<label for="date_fin">Date de fin*</label>
				<input type="date" class="form-control" name="date_fin" id="date_fin" value="<?= set_value('date_fin', @$event->date_fin) ?>">
			</div>
		</div>

		<!--- Section géolocalisation -> api google ------------------------------>
		<hr>
		<div class="form-row">
			<div class="col">
				<label for="latitude">Latitude</label>
				<input type="text" class="form-control" name="latitude" id="latitude" value="<?= set_value('latitude', @$event->latitude) ?>">
			</div>
			<div class="col">
				<label for="longitude">Longitude</label>
				<input type="text" class="form-control" name="longitude" id="longitude" value="<?= set_value('longitude', @$event->longitude) ?>">
			</div>
		</div>

		<br>
		<div class="form-group">
			<button type="submit" id="valider" class="btn btn-dark btn-lg btn-block">VALIDER</button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>
