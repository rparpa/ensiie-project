

<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/display-nav.js"></script>
</head>
<body>
<?php
include "../../src/templates/structure.php";
?>
<main>
    <section class="my-card my-card-100">
        <section class="my-card-header">
            <img src="../static/assets/right-left-solid.svg"/>
            <span>Derniers trocs</span>
        </section>
        <section class="my-card-body">
            <section class="slider">
                <section class="slide-track">
                    <?php require_once "../../src/templates/template-factory.php";
                    templateSwap(1);
                    templateSwap(2);
                    templateSwap(3);
                    templateSwap(4);
                    templateSwap(5);
                    templateSwap(6);
                    templateSwap(7);
                    templateSwap(8);
                    templateSwap(9);
                    templateSwap(10);
                    ?>
                </section>
            </section>
        </section>
    </section>
</main>
</body>
</html>
