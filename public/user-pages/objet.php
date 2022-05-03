<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/check-auth.js"></script>
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/templates.js"></script>
    <script src="../static/js/structure.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
    <script src="../static/js/swap-form.js"></script>
</head>
<body>
<?php
require_once '../../vendor/autoload.php';
require_once "../../src/templates/template-factory.php";
?>
<section id="structure">

</section>
<main class="search center">

    <?php

    use Db\Connection;
    use Db\ItemManager;
    use Db\CategoryManager;

    $noResult = false;
    if (isset($_GET["id"])) {
        $itemManager = new ItemManager(Connection::get());
        $item = $itemManager->findById($_GET["id"]);
        if ($item !== null) {
            templateItem($item);
            echo '<script> sessionStorage.setItem("proprietary", "' . $item->getProprietary()->getMail() . '");</script>';
            if ($item->getIsSwappable() == true) {
                ?>
                <section class="my-card my-card-100" id="form-my-card">
                </section>

                <?php
            }
        } else {
            $noResult = true;
        }
    } else {
        $noResult = true;
    }
    if ($noResult) {
        require_once '../../src/templates/error-message.php';
    }
    ?>
</main>
</body>
</html>