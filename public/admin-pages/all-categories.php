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
    <script src="../static/js/services/categories-service.js"></script>
    <script src="../static/js/utils/templates.js"></script>
    <script src="../static/js/utils/display-nav.js"></script>
    <script src="../static/js/utils/display-img.js"></script>
    <script src="../static/js/pages/ajouter-objet.js"></script>
    <script src="../static/js/pages/admin-pages.js"></script>
    <script src="../static/js/utils/structure.js"></script>


</head>
<body onload="getAllCategories()">
<section id="structure">

</section>
<main>
    <div>
        Barre de recherche
    </div>
    <div class="div-add-category">
        <div class="form-add-category">
            <input type="text" name="new-category-name" class="input-new-cat-name required"
                   placeholder="Nom de la nouvelle catégorie"/>
        </div>
        <div class="div-button-add-category">
            <button class="button-add-category"
                    onclick="addCategory(document.getElementsByClassName('input-new-cat-name')[0].value)">Ajouter une
                catégorie
            </button>
        </div>
    </div>
    <section class="all-categories-container">
    </section>
</main>
</body>
</html>