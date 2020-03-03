<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2>Liste des utilisateurs</h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>code</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Telephone</th>
                <!-- PROMO -->
                <th>Promo</th>
                <th>Signals</th>
                <th>droit de publier</th>
                <th>Administrateur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

                <?php
                    foreach ($users as $user) {
                        echo "<tr><td>".$user['id_user']."</td>
                <td>".$user['nom']."</td>
                <td>".$user['prenom']."</td>
                <td>".$user['email']."</td>
                <td>".$user['telephone']."</td>
                <td>".$user['promo']."</td>
                <td>".$user['nb_signal_user']."</td>";

                if($user['droit_publication'])
                            {
                                echo "<td>Oui</td>";
                            } else echo "<td>Non</td>";
                if($user['admin'])
                        {
                            echo "<td>Oui</td>";
                        } else echo "<td>Non</td>";
                echo "<td>
                    <a href=".site_url('/Utilisateur/update?id='.$user['id_user'])." class=\"settings\" title=\"modifier\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE8B8;</i></a>";
                    
                    if($admin_user==true && $user['id_user']!=$id_user)
                        echo "<a href=\"#\" class=\"delete\" title=\"Bannir\" data-toggle=\"modal\" data-target=\"#suppressionModal".$user['id_user']."\"><i class=\"material-icons\">&#xE5C9;</i></button>";
                echo "</td></tr>";
                ?>
                <!-- The Modal -->
                <div class="modal fade" id="suppressionModal<?php echo $user['id_user'];?>" >
                    <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header text-white bg-danger">
                        <h4 class="modal-title">Suppression du compte <?php echo $user['nom'].' '.$user['prenom']?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                        &Ecirctes-vous sûr de vouloir supprimer cette utilisateur ?
                        </br>Cette action est irreversible.
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">								
                            <button type="button" class="btn btn-danger" onclick="window.location.replace('<?php echo site_url('/Utilisateur/delete/'.$user['id_user']); ?>');">Supprimer</button>
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
