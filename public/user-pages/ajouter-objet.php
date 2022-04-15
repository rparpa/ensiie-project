<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/categories-form.js"></script>
    <script src="../static/js/display-img.js"></script>
    <script src="../static/js/check-form-item.js"></script>
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
                 viewBox="0 0 448 512">
                <path fill="var(--font-color)"
                      d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM224 368C237.3 368 248 357.3 248 344V280H312C325.3 280 336 269.3 336 256C336 242.7 325.3 232 312 232H248V168C248 154.7 237.3 144 224 144C210.7 144 200 154.7 200 168V232H136C122.7 232 112 242.7 112 256C112 269.3 122.7 280 136 280H200V344C200 357.3 210.7 368 224 368z"/>
            </svg>
            <span>Créer un objet</span>
        </section>
        <section class="my-card-body">
            <form class="form" onsubmit="applyValueCategories();return checkForm()" method="POST"
                  action="../actions/create-swap.php"
                  enctype="multipart/form-data">
                <div class="input">
                    <label for="item-name">Nom</label>
                    <span class="error hidden" id="error-name">Vous devez renseigner un nom</span>
                    <input type="text" id="item-name" name="item-name"/>
                </div>
                <div class="input image-input">
                    <label for="file">Photo de l'objet</label>
                    <span class="error hidden" id="error-photo">Vous devez insérer une photo</span>
                    <input type="file" accept="image/*" name="file" id="imgInput" class="hidden"/>
                    <input type="button" value="Parcourir" onclick="document.getElementById('imgInput').click();"/>
                    <img id="result" class="hidden" src="#" alt="your image"/>
                </div>
                <div class="input">
                    <label for="description">Description</label>
                    <span class="error hidden" id="error-description">Vous devez renseigner une description</span>
                    <textarea name="description" id="description"></textarea>
                </div>
                <div class="input">

                    <label>Catégories</label>
                    <div class="search-category" id="button-container">
                        <?php

                        use Db\Connection;
                        use Db\CategoryManager;

                        $categoryManager = new CategoryManager(Connection::get());
                        $categories = $categoryManager->findAll();
                        foreach ($categories as $category) {
                            echo "<button class='category-button' type='button' value="
                                .htmlspecialchars($category->getId(), ENT_QUOTES, 'UTF-8').
                                " onclick='clickCategory(this)'>"
                                .htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8').
                                "</button>";
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" id="category-selected" name="categories-selected"/>
                <div class="actions">
                    <button type="reset" onclick="deselectCategories();clearErrors()">EFFACER</button>
                    <button type="submit">RECHERCHER</button>
                </div>
            </form>
        </section>
    </section>
</main>
</body>
</html>
