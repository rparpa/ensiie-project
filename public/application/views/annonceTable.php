<div class="container">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-5">
					<h2>Liste des annonces</h2>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>Titre</th>
				<th>Description</th>
				<th>Prix</th>
				<th>Vendu</th>
				<th>Signals</th>
				<th>Date de publication</th>
			</tr>
			</thead>
			<tbody>

			<?php
			foreach ($annonces as $ann) {
				echo "<tr><td>".$ann['titre']."</td>
                <td>".$ann['description']."</td>
                <td>".$ann['prix']."</td>
                <td>".$ann['vendu']."</td>
                <td>".$ann['nb_signal']."</td>
                <td>".$ann['date_publication']."</td>
                <td>
					<a href=\"#\" class=\"delete\" title=\"Bannir\" data-toggle=\"modal\" data-target=\"#suppressionModal".$ann['id_annonce']."\"><i class=\"material-icons\">&#xE5C9;</i></button>
					</td></tr>";
					?>
					<!-- The Modal -->
					<div class="modal fade" id="suppressionModal<?php echo $ann['id_annonce'];?>" >
						<div class="modal-dialog">
						<div class="modal-content">
	
							<!-- Modal Header -->
							<div class="modal-header text-white bg-danger">
							<h4 class="modal-title">Suppression de l'annonce <?php echo $ann['titre']?></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							
							<!-- Modal body -->
							<div class="modal-body">
							&Ecirctes-vous sûr de vouloir supprimer cette annonce ?
							</br>Cette action est irreversible.
							</div>
							
							<!-- Modal footer -->
							<div class="modal-footer">								
								<button type="button" class="btn btn-danger" onclick="window.location.replace('<?php echo site_url('/Annonce/supprimer_annonce/'.$ann['id_annonce']); ?>');">Supprimer</button>
								<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-hidden="true">Annuler</button>
							</div>
							
						</div>
						</div>
					</div>
					<?php
					}
					?>

			</tbody>
		</table>
	</div>
</div>
