<?php foreach($users as $user): ?>
	<div class="row">
		<div class="col-2">
			<a href="<?= base_url('user/profil/'.$user->id) ?>"><?= $user->login; ?></a>
		</div>
		<div class="col-2">
			<?= $user->prenom.' '.$user->nom; ?>
		</div>
		<?php if ($user->est_ami==false): ?>
			<div class="col-2">
				<a href="<?= base_url('ami/ajouter/'.$user->id); ?>">Ajouter</a>
			</div>
		<?php endif; ?>
		<hr></hr>
	</div>
<?php endforeach; ?>