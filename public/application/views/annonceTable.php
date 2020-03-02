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
                    <a href=".site_url('/Annonce/supprimer_annonce/'.$ann['id_annonce'])." class=\"glyphicon glyphicon-flag\" title=\"Signaler\" data-toggle=\"tooltip\">Supprimer</i></a>
                </td></tr>";
			}
			?>

			</tbody>
		</table>
	</div>
</div>
