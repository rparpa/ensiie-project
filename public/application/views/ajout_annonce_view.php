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
        //Ouverture du formulaire
        //echo form_open($this->uri->uri_string(), array('id' => 'formModif', 'class' => 'form-horizontal'));
        echo form_open('');
    ?>
    <div class="form-group">

        <!--Structure de la rubrique description-->
        <div class="card ">
                <h5 class="card-header text-white bg-primary">Nouvelle annonce</h5>
            <div class="card-body">

                <!-- //Ouverture de la balise row correspondant à la ligne titre -->
                <div class="row">
                <?php
                //Si l'utilisation créé une nouvelle annonce
                    if(1==1){
                        echo '<div class="col-md">';
                            echo form_label('Titre de l\'annonce :&nbsp;', 'titre','class="control-label"');
                            echo form_input('titre', "", 'class="form-control"');
                        echo '</div>';

                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                            echo '<b>Titre de l\'annonce : </b>' . "valeur" . '<br>';
                        echo '</div>';
                    echo '</br>';
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
                    if(1==1){
                        echo '<div class="col-md">';
                            echo form_label('Description de l\'annonce :&nbsp;', 'description');
                            echo form_textarea('description', "", 'class="form-control" style="resize: none;"');
                        echo '</div>';
                    }
                    //Sinon
                    else {
                        echo '<div class="col-md-4">';
                            echo '<b>Description de la formation : </b>';
                        echo '</div>';
                        echo '<div class="col-md-8" align="justify">';
                            echo '<p>' . nl2br("valeur") . '</p><br>';
                        echo '</div>';
                    }
                ?>    
                <!-- Fermeture de la balise row correspondant à la ligne titre-->
                </div> 

                </br>

                <!-- //Ouverture de la balise row correspondant à la ligne prix -->
                <div class="row">
                <?php
                //Si l'utilisation créé une nouvelle annonce
                    if(1==1){
                        echo '<div class="col-md-2 mb-3">';
                            echo form_label('Prix de l\'objet :&nbsp;', 'prix','class="control-label"');
                            echo form_input('prix', "", 'class="form-control"');
                        echo '</div>';
                    
                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                            echo '<b>Prix de l\'annonce : </b>' . "valeur" . '<br>';
                        echo '</div>';
                    echo '</br>';
                    }

                //Si l'utilisation créé une nouvelle annonce
                    if(1==1){
                        echo '<div class="col-md-2 mb-3">';
                            echo form_label('Etat de l\'objet :&nbsp;', 'etat','class="control-label"');
                            echo form_dropdown('etat',$etats,5,'class="form-control"');
                        echo '</div>';
                    
                    //Sinon
                    }else{
                        echo '<div class="col-md">';
                            echo '<b>Prix de l\'annonce : </b>' . "valeur" . '<br>';
                        echo '</div>';
                    echo '</br>';
                    }
                ?>
                <!-- Fermeture de la balise row correspondant à la ligne prix-->
                </div>   

            

            <!-- //Ouverture de la balise row correspondant à l'upload de l'image -->
                <div class="row">
                <?php
                //Si l'utilisation créé une nouvelle annonce
                    if(1==1){
                        echo '<div class="col-md ">';
                            echo form_label('Image(s) de l\'objet :&nbsp;', 'image','class="control-label"');
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
        echo form_submit('ajout_annonce','Ajouter',array('type'=>'button','class'=>"float-right btn btn-success"));
        echo form_close();
    ?>

</div>

<script>

    var myDropzone = new Dropzone("#dropzone", { 
        url: "<?php echo (base_url('index.php/Annonce/fileUpload'));?>"
    });

    // Add restrictions
    Dropzone.options.fileupload = {
      acceptedFiles: 'image/*',
      maxFilesize: 10 // MB
    };

/*      window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove();
        });
      }, 2000);*/

      $(".alert").on("close.bs.alert", function () {
      $alertMsg.hide();
      return false;
});

</script>