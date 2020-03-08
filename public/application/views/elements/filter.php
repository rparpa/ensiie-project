	<!-- Jumbotron Header -->
	<header class="card mb-4 box-shadow mx-auto">
			<div class="card-body">
				<input class="form-control" id="myInput" type="text" placeholder="Rechercher une annonce ...">
				</br>
					<!--<form method="post" action="<?php  echo base_url().'index.php/annonce/filter/'?>">-->
					<div class="row">
						<div class="col-md-4 col-mb-3 d-flex flex-row">
							<input class="form-control" type="number" id="min" name="min" value="<?php echo $min;?>">
							<input class="form-control" type="number" id="max" name="max" value="<?php echo $max;?>">
							<button class="btn btn-warning" id="filtre" name="filtre">Filtrer</button>		
                        </div>
                        <div class="col-md-3 col-mb-3">
                            <select class="form-control search-slt" id="categorie" >
                            <option value="all" disabled selected>Filtrer par categorie ...</option>
                                <?php
                                    foreach($categories as $categorie)
                                        echo '<option>'.$categorie.'</option>';
                                ?>
                            </select>
                        </div>	
					</div>
                    <button class="float-md-right btn btn-info" id='reset' onclick="document.getElementById('myInput').value = ''">Reset</button>
			</div>
			<!--</form>-->



    <script>
        $(document).ready(function(){
            
            //Gestion de la barre de rechercher
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".annonce").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            //Gestion du bouton filtrage des prix
            $("#filtre").click(function(){
                var min = $("#min")[0]['valueAsNumber'];
                var max = $("#max")[0]['valueAsNumber'];

                $(".annonce").filter(function() {
                $(this).toggle($(this)[0]['firstChild']['value']>=min && $(this)[0]['firstChild']['value']<=max);
                });
                    
            });

            //Gestion du filtrage des categoties
            $('#categorie').click(function(){
                var categorie = $(this).val().toLowerCase();
                $(".annonce").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(categorie) > -1)
                });
            });

            //Gestion du bouton reset
            $("#reset").click(function(){
                console.log($("#categorie")[0]['value']);
                $('.annonce').show('1000');
                $("#myInput").val()="";
            });

        });
    </script>