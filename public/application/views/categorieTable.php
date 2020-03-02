<div class="container">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-5">
					<h2>Liste des catégories</h2>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>Catégories</th>
			</tr>
			</thead>
			<tbody>

			<?php
			foreach ($categories as $categ) {
				echo "<tr><td>".$categ['categorie']."</td>
                <td>
                    <a href=".site_url('/Categorie/delete/'.$categ['id_categorie'])." class=\"glyphicon glyphicon-flag\" title=\"Signaler\" data-toggle=\"tooltip\">Supprimer</i></a>
                    <a href=".site_url('/Categorie/update/'.$categ['id_categorie'])." class=\"glyphicon glyphicon-flag\" title=\"Signaler\" data-toggle=\"tooltip\">Modifier</i></a>
                </td></tr>";
			}
			?>

			</tbody>
		</table>
	</div>
</div>
