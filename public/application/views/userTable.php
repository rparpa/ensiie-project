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
                <td>".$user['nb_signal_user']."</td>
                <td>
                    <a href=".site_url('/Utilisateur/update?id='.$user['id_user'])." class=\"settings\" title=\"modifier\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE8B8;</i></a>
                    <a href=".site_url('/Utilisateur/delete/'.$user['id_user'])." class=\"delete\" title=\"Bannir\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE5C9;</i></a>
                </td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
