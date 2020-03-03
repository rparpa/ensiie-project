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
				<th><?php echo "<a href=".site_url('/Categorie/ajouter_categorie/')." class=\"glyphicon glyphicon-flag\" title=\"Ajouter\" data-toggle=\"tooltip\">Ajouter</i></a></th>"?>
			</tr>
			</thead>
			<tbody>

			<?php
			foreach ($categories as $categ) {
				echo "<tr><td>".$categ['categorie']."</td>
                <td>
                    <a href=".site_url('/Categorie/modifier_categorie/'.$categ['id_categorie'])." class=\"glyphicon glyphicon-flag\" title=\"Modifier\" data-toggle=\"tooltip\">Modifier</i></a>
                    <a href=".site_url('/Categorie/delete/'.$categ['id_categorie'])." class=\"glyphicon glyphicon-flag\" title=\"Supprimer\" data-toggle=\"tooltip\">Supprimer</i></a>
                </td></tr>";
			}
			?>

			</tbody>
		</table>
	</div>
</div>
