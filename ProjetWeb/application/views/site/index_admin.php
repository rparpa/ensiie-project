

<h1>Gestion</h1>

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="liste_users" data-toggle="list" href="#users" role="tab" aria-controls="users">Gérer les users</a>
      <a class="list-group-item list-group-item-action" id="liste_groupes" data-toggle="list" href="#groupes" role="tab" aria-controls="groupes">Gérer les groupes</a>
      <a class="list-group-item list-group-item-action" id="liste_events" data-toggle="list" href="#events" role="tab" aria-controls="events">Gérer les events</a>
      <a class="list-group-item list-group-item-action" id="liste_tags" data-toggle="list" href="#tags" role="tab" aria-controls="tags">Gérer les tags</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="liste_users">
      	<h2>Liste des users</h2>
          <table id="table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($users as $user): ?>
                <?php if($user->id!==$this->auth->check_is_user()): ?>
                  <tr>
                    <td><?= $user->id; ?></td>
                    <td><?= $user->login; ?></td>
                    <td><?= $user->email; ?></td>
                    <td><a href="<?= base_url('user/modifier/'.$user->id) ?>" class="btn btn-succes"><i class="far fa-edit"></i></a><a href="<?= base_url('user/supprimer/'.$user->id) ?>" class="btn btn-succes"><i class="fas fa-times"></i></a>
                    </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>

      </div>
      <div class="tab-pane fade" id="groupes" role="tabpanel" aria-labelledby="liste_groupes">
      	<h2>Liste des groupes</h2>
        <table id="table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($groupes as $groupe): ?>
              <?php if($groupe->id!==$this->auth->check_is_user()): ?>
                <tr>
                  <td><?= $groupe->id; ?></td>
                  <td><?= $groupe->nom; ?></td>
                  <td><?= $groupe->description; ?></td>
                  <td><a href="<?= base_url('groupe/modifier/'.$groupe->id) ?>" class="btn btn-succes"><i class="far fa-edit"></i></a><a href="<?= base_url('groupe/supprimer/'.$groupe->id) ?>" class="btn btn-succes"><i class="fas fa-times"></i></a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="liste_events">
      	<h2>Liste des events</h2>
          <table id="table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Organisateur</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($events as $event): ?>
                  <tr>
                    <td><?= $event->id; ?></td>
                    <td><?= $event->titre; ?></td>
                    <td><?= $event->description; ?></td>
                    <td><?= $event->organisateur_id; ?></td>
                    <td>
                      <a href="<?= base_url('event/edit/'.$event->id) ?>" class="btn btn-succes"><i class="far fa-edit"></i></a><a href="<?= base_url('event/delete/'.$event->id) ?>" class="btn btn-succes"><i class="fas fa-times"></i></a>
                    </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
      </div>
      <div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="liste_tags">
      	<h2>Liste des tags</h2>
          <table id="table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Est Actif</th>
                <th>Soumetteur</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($tags as $tag): ?>
                  <tr>
                    <td><?= $tag->id; ?></td>
                    <td><?= $tag->nom; ?></td>
                    <td><?= $tag->est_valide; ?></td>
                    <td><?= $tag->soumetteur; ?></td>
                    <td><a href="<?= base_url('tags/valider/'.$tag->id) ?>" class="btn btn-succes"><i class="fas fa-check"></i></a>
                      <a href="<?= base_url('tags/modifier/'.$tag->id) ?>" class="btn btn-succes"><i class="far fa-edit"></i></a><a href="<?= base_url('tags/supprimer/'.$tag->id) ?>" class="btn btn-succes"><i class="fas fa-times"></i></a>
                    </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
