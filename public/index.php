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
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button>
        </form>
    </div>
</nav>

<body>

    <form class="center">
        <div class="form-group">
            <label for="exampleInputJobs">Quoi ?</label>
            <input type="text" class="form-control" id="exampleInputJobs" aria-describedby="jobsHelp" placeholder="">
            <small id="jobsHelp" class="form-text text-muted">Que cherchez vous ?</small>
        </div>
        <div class="form-group">
            <label for="exampleInputLocation">Ou ?</label>
            <input type="text" class="form-control" id="exampleInputLocation" placeholder="">
            <small id="jobsHelp" class="form-text text-muted">Ou ça ? Quelle ville ?</small>
        </div>

        <button type="submit" class="btn btn-primary">Chercher</button>
    </form>

</body>

</html>

<script>
    function myFunction() {
        document.getElementById("demo").style.color = "red";
    }
</script>