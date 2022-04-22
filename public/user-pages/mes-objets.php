<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/templates.js"></script>
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/my-items.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
</head>
<body>
<?php
require_once '../../vendor/autoload.php';
include "../../src/templates/structure.php";
?>
<main>
    <section id="items-container" class="grid">
    </section>
</main>
</body>
</html>
