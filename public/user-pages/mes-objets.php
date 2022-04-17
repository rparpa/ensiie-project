<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/escapeHtml.js"></script>
    <script src="../static/js/no-result.js"></script>
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/my-items.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
</head>
<body>
<?php

use Db\Connection;
use Db\ItemManager;

include "../../vendor/autoload.php";
include "../../src/templates/structure.php";
?>
<main>
    <section id="items-container" class="grid">
        <?php
        require_once "../../src/templates/template-factory.php";
        $items = (new ItemManager(Connection::get()))->findAllByProprietaryMail("toto");
        foreach ($items as $item) {
            templateItem($item);
        }
        ?>
    </section>
</main>
</body>
</html>
