<html lang="fr">
<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">
    <script src="../static/js/display-nav.js"></script>
    <script src="../static/js/apply-category-color.js"></script>
    <script src="../static/js/swap-form.js"></script>
</head>
<body>
<?php
require_once '../../vendor/autoload.php';
include "../../src/templates/structure.php";
require_once "../../src/templates/template-factory.php";
?>
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
            ?>
            <section class="my-card">
                <section class="my-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path fill="var(--font-color)"
                              d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"/>
                    </svg>
                    <span>Proposer un échange</span>
                </section>
                <section class="my-card-body">
                    <form class="form" onsubmit="applyValueItems();return checkForm()" method="POST"
                          action="../actions/create-swap.php">
                        <div class="input">
                            <label>Vos objets</label>
                            <span class="error hidden"
                                  id="error-item">Vous devez séléctionner au moins un objet</span>
                            <div id="button-item-container">
                                <?php

                                $items = $itemManager->findAllByProprietaryMail("titi");
                                foreach ($items as $item) {
                                    echo "<button class='item-button' type='button' value="
                                        . htmlspecialchars($item->getId(), ENT_QUOTES, 'UTF-8') .
                                        " onclick='clickItem(this)'>"
                                        . "<span class='name'>" . htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') . "</span>"
                                        . "<img src='/images/items/" . htmlspecialchars($item->getPicture(), ENT_QUOTES, 'UTF-8') . "'/>";
                                    echo "<div class='categories' id='cat-container'>";
                                    foreach ($item->getCategories() as $category) {
                                        echo "<span class='category'>" . htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8') . "</span>";
                                    }
                                    echo "</div>";
                                    echo "</button>";
                                }
                                ?>
                            </div>
                        </div>
                        <input type="hidden" id="items-selected" name="categories-selected"/>
                        <div class="actions">
                            <button type="reset" onclick="deselectCategories();clearErrors()">EFFACER</button>
                            <button type="submit">DEMANDER UN TROC</button>
                        </div>
                    </form>
                </section>
            </section>
            </section>


            <?php
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