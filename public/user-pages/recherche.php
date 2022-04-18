<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/no-result.js"></script>
    <script src="../static/js/escapeHtml.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
    <script src="../static/js/categories-form.js"></script>
    <script src="../static/js/search.js"></script>
</head>
<body>
<?php
require_once '../../vendor/autoload.php';
include "../../src/templates/structure.php";
?>
<main class="search">
    <section class="my-card my-card-100">
        <section class="my-card-header">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512">
                <path fill="var(--font-color)"
                      d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/>
            </svg>
            <span>Critères de recherche</span>
        </section>
        <section class="my-card-body">
            <form class="form" action="javascript:void(0)" onsubmit="search()">
                <div class="search-bar">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"/>
                    </svg>
                    <input type="text" id="search-name" placeholder="Entrez le nom de l'objet">
                </div>
                <div class="search-category" id="button-container">
                    <?php

                    use Db\Connection;
                    use Db\CategoryManager;
                    use models\Category;

                    $categoryManager = new CategoryManager(Connection::get());
                    $categories = $categoryManager->findAll();
                    foreach ($categories as $category) {
                        echo "<button class='category-button' type='button' value="
                            . htmlspecialchars($category->getId(), ENT_QUOTES, 'UTF-8') .
                            " onclick='clickCategory(this)'>"
                            . htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8') .
                            "</button>";
                    }
                    ?>
                </div>
                <div class="actions">
                    <button type="reset" onclick="deselectCategories(); clearResults()">EFFACER</button>
                    <button type="submit">RECHERCHER</button>
                </div>
            </form>
        </section>
    </section>
    <section id="results" class="results">
    </section>

</main>
</body>
</html>
