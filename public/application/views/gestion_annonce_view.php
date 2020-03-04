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
        if($this->uri->ruri_string() != 'Annonce/ajouter_annonce')
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
                        echo '<h5 class="card-header text-white bg-success">Nouvelle annonce</h5>';
                    else
                        echo '<h5 class="card-header text-black bg-warning">Modifier annonce</h5>';
                ?>
            <div class="card-body">

                <!-- //Ouverture de la balise row correspondant à la ligne titre -->
                <div class="row">
                <?php
                //Si l'utilisateur créé une nouvelle annonce
                    if(!$modif){
                        echo '<div class="col-md">';
                            echo form_label('Titre de l\'annonce :&nbsp;', 'titre','class="control-label"');
                            echo form_input('titre', "", 'class="form-control"');
                        echo '</div>';
                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                        echo form_label('Titre de l\'annonce :&nbsp;', 'titre','class="control-label"');
                        echo form_input('titre',$annonce_modif['titre'], 'class="form-control"');
                    echo '</div>';
                    }
                ?>
                <!-- Fermeture de la balise row correspondant à la ligne titre-->
                </div>

                </br>

                <!-- //Ouverture de la balise row correspondant à la ligne titre -->
                <div class="row">
                <?php
                //if($this->uri->ruri_string()!= 'formations/demande_ajout_formation')
                //Si l'utilisation créé une nouvelle annonce
                    if(!$modif){
                        echo '<div class="col-md">';
                            echo form_label('Description de l\'annonce :&nbsp;', 'description');
                            echo form_textarea('description', "", 'class="form-control" style="resize: none;"');
                        echo '</div>';
                    }
                    //Sinon
                    else {
                        echo '<div class="col-md">';
                            echo form_label('Description de l\'annonce :&nbsp;', 'description');
                            echo form_textarea('description', $annonce_modif['description'], 'class="form-control" style="resize: none;"');
                        echo '</div>';
                    }
                ?>    
                <!-- Fermeture de la balise row correspondant à la ligne titre-->
                </div> 

                </br>

                <!-- //Ouverture de la balise row correspondant à la ligne prix -->
                <div class="row">
                <?php
                //Si l'utilisateur créé une nouvelle annonce
                    if(!$modif){
                        echo '<div class="col-md-2 mb-3">';
                            echo form_label('Prix de l\'objet :&nbsp;', 'prix','class="control-label"');
                            echo form_input('prix', "", 'class="form-control"');
                        echo '</div>';
                    
                    //Sinon
                    }else{
                        echo '<div class="col-md-2 mb-3">';
                            echo form_label('Prix de l\'objet (en €):&nbsp;', 'prix','class="control-label"');
                            echo form_input('prix', $annonce_modif['prix'], 'class="form-control"');
                        echo '</div>';
                    }

                //Si l'utilisation créé une nouvelle annonce
                    if(!$modif){
                        echo '<div class="col-md-">';
                            echo form_label('Etat de l\'objet :&nbsp;', 'etat','class="control-label"');
                            echo form_dropdown('etat',$etats,5,'class="form-control"');
                        echo '</div>';
                    
                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                            echo form_label('Etat de l\'objet :&nbsp;', 'etat','class="control-label"');
                            echo form_dropdown('etat',$etats,$annonce_modif['id_etat'],'class="form-control"');
                        echo '</div>';
                    }

                    //Si l'utilisation créé une nouvelle annonce
                    if(!$modif){
                        echo '<div class="col-md categorie">';  
                        echo form_label('Categorie de l\'objet :&nbsp;', 'objet','class="control-label"');
                        echo form_dropdown('test',$categories,5,'class="form-control list_categorie"');
                        echo form_input('categorie', '', array('type'=>'text','data-role'=>'tagsinput fqsfqs' ,'value'=>'jQuery,Script,Net', 'class'=>'input_categorie form-control'));               
                        echo '</div>';
                    
                    //Sinon
                    }else{
                        echo '<div class="col-md categorie_modif">';  
                        echo form_label('Categorie de l\'objet :&nbsp;', 'objet','class="control-label"');
                        echo form_dropdown('test',$categories,5,'class="form-control list_categorie"');
                        echo form_input('categorie',implode(",",$categorie_modif), array('type'=>'text','data-role'=>'tagsinput fqsfqs' , 'class'=>'input_categorie form-control'));               
                        echo '</div>';
                    }                    

                ?>
                <!-- Fermeture de la balise row correspondant à la ligne prix-->
                </div>   

            

            <!-- //Ouverture de la balise row correspondant à l'upload de l'image -->
                <div class="row">
                <?php
                //Si l'utilisation créé une nouvelle annonce
                    if(1==1){
                        echo '<div class="col-md image_upload">';
                            echo form_label('Image(s) de l\'objet :&nbsp;', 'image','class="control-label"');
                            echo form_hidden('image', '');
                            echo '<div id="dropzone" class="dropzone" ></div>';
                        echo '</div>';
                        
                  
                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                            echo '<b>Prix de l\'annonce : </b>' . "valeur" . '<br>';
                        echo '</div>';
                    echo '</br>';
                    }

                ?>
                <!-- Fermeture de la balise row correspondant à l'upload de l'image-->
                </div>           

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


    $(".categorie_modif ").change(function(){
        var elt = $(".categorie_modif .input_categorie");
        elt.tagsinput({
            itemValue: 'id',
            itemText: 'text'
        });
        var index_categorie = parseInt($(".categorie_modif  .list_categorie").val())
        var cat = $(".categorie_modif  .list_categorie")[0][index_categorie]['label']
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