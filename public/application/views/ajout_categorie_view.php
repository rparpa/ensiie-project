<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>

<!-- Container Boostrap -->
</br>
<div class="container">
	<?php
	if($this->session->flashdata('message')!=null)
		echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('message').'</div>';
	if($this->session->flashdata('error')!=null)
		echo '<div class="alert alert-danger alert-dismissible fade-show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('error').'</div>';
	if(validation_errors())
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.validation_errors().'</div>';
	?>

	<?php
	echo form_open('');
	?>
	<div class="form-group">
		<!--Structure de la rubrique description-->
		<div class="card ">
			<h5 class="card-header text-white bg-primary">Nouvelle catégorie</h5>
			<div class="card-body">

				<!-- //Ouverture de la balise row correspondant à la ligne titre -->
				<div class="row">
					<?php
					//Si l'utilisateur créé une nouvelle catégorie
					if(1==1){
						echo '<div class="col-md">';
						echo form_label('Titre de la catégorie:&nbsp;', 'categ','class="control-label"');
						$data_name = array(
							'data' => 'categ',
							'value' => '',
							'placeholder' => 'Ex : Loisirs, Informatique..',
							'extra' => 'class="form-control"'
						);
						echo "<br>".form_input($data_name);
						echo '</div>';

						//Sinon
					}else{
						echo '<div class="col-md">';
						echo '<b>Titre de la catégorie : </b>' . "valeur" . '<br>';
						echo '</div>';
						echo '</br>';
					}
					?>
				</div>
			</div>
		</div>
	</div>

	</br>
	<?php
	echo form_submit('ajout_categorie','Ajouter',array('type'=>'button','class'=>"float-right btn btn-success"));
	echo form_close();
	?>

</div>
