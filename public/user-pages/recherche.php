<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
    <script src="../static/js/search-form.js"></script>
</head>
<body>
<?php
include "../../src/templates/structure.php";
?>
<main class="search">
    <section class="my-card my-card-100">
        <section class="my-card-header">
            <img src="../static/assets/filter-solid.svg"/>
            <span>Critères de recherche</span>
        </section>
        <section class="my-card-body">
            <form class="search-form">
                <div class="search-bar">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"/>
                    </svg>
                    <input type="text" placeholder="Entrez le nom de l'objet">
                </div>
                <div class="search-category" id="button-container">
                    <button class="category-button" type="button" value="1" onclick="clickCategory(this)">EDUCATION</button>
                    <button class="category-button" type="button" value="2" onclick="clickCategory(this)">CHEAT CODE</button>
                    <button class="category-button" type="button" value="3" onclick="clickCategory(this)">MANGA</button>
                    <button class="category-button" type="button" value="4" onclick="clickCategory(this)">SCIENCE FICTION
                    </button>
                    <button class="category-button" type="button" value="5" onclick="clickCategory(this)">INUTILE</button>
                    <button class="category-button" type="button" value="6" onclick="clickCategory(this)">TECHNOLOGIE</button>
                </div>
                <div class="actions">
                    <button type="reset" onclick="deselectCategories()">EFFACER</button>
                    <button type="submit">RECHERCHER</button>
                </div>
            </form>
        </section>
    </section>
    <section class="results">
        <span class="number-result">14 objet(s) trouvé(s)</span>
        <section class="item-list">
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
            <a class="item-link">
                <img src="../static/assets/stylo.jpg"/>
                <div class="information">
                    <h3>Stylo Frixion Bleu sans Cartouche</h3>
                    <span class="date">Date d'ajout: 04/01/2002</span>
                    <div class="categories" id="cat-container">
                        <span class="category">CHEAT CODE</span>
                        <span class="category">EDUCATION</span>
                    </div>
                </div>
                <div class="user">
                    <img src="../static/assets/zoro.jpg"/>
                    <span>Jonathan</span>
                </div>
            </a>
        </section>
    </section>

</main>
</body>
</html>
