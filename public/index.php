<?php

require_once '../src/Bootstrap.php';

$userRepository = new \User\UserRepository(\Db\Connection::get());
$users = $userRepository->fetchAll();
?>

<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <a class="navbar-brand" href="#">In Fact</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Lancer une recherche <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-light my-2 my-sm-0" type="button" data-toggle="modal" data-target="#connexionModal" >Connexion</button>
        </form>

        <form class="form-inline my-2 my-lg-0 pl-2">
            <button class="btn btn-outline-light my-2 my-sm-0" type="button" data-toggle="modal" data-target="#inscriptionModal" >Inscription</button>
        </form>
    </div>

    <!-- Modal connexion -->
    <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Identifiant</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Adresse mail</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Confirmer</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal inscription -->
    <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputNom">Nom</label>
                    <input type="text" class="form-control" id="inputNom">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPrenom">Prenom</label>
                    <input type="text" class="form-control" id="inputPrenom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Adresse</label>
                    <input type="text" class="form-control" id="inputAddress">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                    <label for="inputCity">Ville</label>
                    <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="inputZip">Code Postal</label>
                    <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Je suis une entreprise
                    </label>
                    </div>
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Confirmer</button>
            </div>
            </div>
        </div>
    </div>

</nav>

<body>

    <!-- Recherche -->
    <form class="center">
        <div class="form-group">
            <label for="exampleInputJobs">Quoi ?</label>
            <input type="text" class="form-control" id="exampleInputJobs" aria-describedby="jobsHelp" placeholder="">
            <small id="jobsHelp" class="form-text text-muted">Quel métier ?</small>
        </div>
        <div class="form-group">
            <label for="exampleInputLocation">Ou ?</label>
            <input type="text" class="form-control" id="exampleInputLocation" placeholder="">
            <small id="jobsHelp" class="form-text text-muted">Quelle ville ?</small>
        </div>

        <button type="submit" class="btn btn-primary">Chercher</button>
    </form>

</body>


</html>