<html>
<head>
	<title>Ajouter des annonces</title>
	<meta charset="utf-8">
</head>
<body>

<div>
	<?php echo form_open(); ?>
	<h1>Création d'une annonce</h1><hr/>
	<?php if (isset($message)) { ?>
		<CENTER><h3 style="color:green;">Annonce ajoutée avec succès!</h3></CENTER><br>
	<?php } ?>
	<?php echo form_label('Titre :'); form_error('titre'); ?><br />
	<?php echo form_input(array('id' => 'titre', 'name' => 'titre', 'type' => 'text', 'placeholder' => 'Ex : Ordinateur neuf à vendre')); ?><br />

	<?php echo form_label('Description :'); form_error('descri'); ?><br />
	<?php echo form_input(array('id' => 'descri', 'name' => 'descri', 'type' => 'text', 'placeholder' => 'Ex : Description détaillée de l\'article')); ?><br />

	<?php echo form_label('Prix :'); form_error('prix'); ?><br />
	<?php echo form_input(array('id' => 'prix', 'name' => 'prix', 'type' => 'number', 'placeholder' => 'Ex : 500')); ?><br />

	<?php echo form_submit(array('id' => 'submit', 'name' => 'save', 'value' => 'Submit')); ?>
	<?php echo form_close(); ?><br/>
	<div>

	</div>
</div>
</body>
</html>
