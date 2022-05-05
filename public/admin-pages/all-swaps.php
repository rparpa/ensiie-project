<?php
require_once '../../vendor/autoload.php';
?>

<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/services/auth-service.js"></script>
    <script src="../static/js/services/notifications-service.js"></script>
    <script src="../static/js/services/swaps-service.js"></script>
    <script src="../static/js/utils/templates.js"></script>
    <script src="../static/js/utils/display-nav.js"></script>
    <script src="../static/js/utils/display-img.js"></script>
    <script src="../static/js/utils/structure.js"></script>
    <script src="../static/js/pages/ajouter-objet.js"></script>
    <script src="../static/js/pages/admin-pages.js"></script>
</head>
<body onload="getAllTrocs()">
<section id="structure">

</section>
<main>
    <div>
        Barre de recherche
    </div>
    <section class="all-swaps-container">
    </section>
</main>
</body>
</html>

