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
	//Variable modif à true si modification
	$modif=false;
	if($this->uri->ruri_string() != 'Categorie/ajouter_categorie')
		$modif=true;

	//Ouverture du formulaire
	//echo form_open($this->uri->uri_string(), array('id' => 'formModif', 'class' => 'form-horizontal'));
	echo form_open('');
	?>
	<div class="form-group">

		<!--Structure de la rubrique description-->
		<div class="card ">
			<?php
			if(!$modif)
				echo '<h5 class="card-header text-white bg-success">Nouvelle catégorie</h5>';
			else
				echo '<h5 class="card-header text-black bg-warning">Modifier catégorie</h5>';
			?>
			<div class="card-body">

				<!-- //Ouverture de la balise row correspondant à la ligne titre -->
				<div class="row">
					<?php
					//Si l'utilisateur crée une nouvelle annonce
					if(!$modif){
						echo '<div class="col-md">';
						echo form_label('Titre de la catégorie :&nbsp;', 'categ','class="control-label"');
						echo form_input('categ', "", 'class="form-control"');
						echo '</div>';
						//Sinon
					}else{
						echo '<div class="col-md">';
						echo form_label('Titre de la catégorie :&nbsp;', 'categ','class="control-label"');
						echo form_input('categ',$categories['categorie'], 'class="form-control"');
						echo '</div>';
					}
					?>
					<!-- Fermeture de la balise row correspondant à la ligne titre-->
				</div>
				</br>

				<!-- Fermeture de la balise card-body de la rubrique description-->
			</div>
			<!--Fermeture de la balise card de la rubrique description-->
		</div>

	</div>

	</br>
	<?php
	if(!$modif)
		echo form_submit('ajout_annonce','Ajouter',array('type'=>'button','class'=>"float-right btn btn-success"));
	else
		echo form_submit('modif_annonce','Mettre à jour',array('type'=>'button','class'=>"float-right btn btn-warning"));
	echo form_close();
	?>

</div>

<script>

	$(document).ready(function(){
		$(".categorie").change(function(){
			var elt = $(".categorie .input_categorie");
			elt.tagsinput({
				itemValue: 'id',
				itemText: 'text'
			});
			var index_categorie = parseInt($(".categorie .list_categorie").val())
			var cat = $(".categorie .list_categorie")[0][index_categorie]['label']
			elt.tagsinput('add',{ id: index_categorie, text: cat });
		});


	});
	//Gestion de l'importation de l'image
	var myDropzone = new Dropzone("#dropzone", {
		url: "<?php echo (base_url('index.php/Annonce/fileUpload'));?>",
		success: function(file, response){
			var args = Array.prototype.slice.call(arguments);
			var nom_image=args[0]['name']
			$('.image_upload input').val($('.image_upload input').val()+nom_image);
			console.log($('.image_upload input'))
		}
	});

	// Add restrictions
	Dropzone.options.fileupload = {
		acceptedFiles: 'image/*',
		maxFilesize: 10 // MB
	};

	/*window.setTimeout(function() {
		$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
		  $(this).remove();
		});
	  }, 2000);*/

	$(".alert").on("close.bs.alert", function () {
		$alertMsg.hide();
		return false;




	});


</script>
