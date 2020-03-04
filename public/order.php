<?php
require_once '../src/Bootstrap.php';

use Ingredient\IngredientRepository;
use Ingredient\IngredientService;

$my_connection = \Db\Connection::get();
$ingredientService = new IngredientService(new IngredientRepository($my_connection));

$availableIngredients = $ingredientService->getAvailableIngredients();

?>

<?php include 'header.php';?>

<!-- Main -->
<div id="main">


<!-- commander -->
<article id="order">
    <h1 class="major">Commander</h1>

    <section>
        <h3>Pimp my sandwich</h3>
        <br>
        <div class="table-wrapper">
            <form action="invoice.php" id="sandwichForm" method="POST">
            <table class="alt customSandwich">
                <thead>
                <tr>
                    <th>Ingrédient</th>
                    <th>Description</th>
                    <th>Sélectionner</th>
                </tr>
                </thead>
                <tbody>

                    <?
                    foreach ($availableIngredients as $ingredient) {

                        echo "<tr class=\"item\">
                                    <td>
                                        <img src=\"" . $ingredient->getImageLink() . "\" width=\"50%\" alt=\"\" style=\"vertical-align: middle\"/>
                                    </td>
                                    
                                    <td class=\"ingredLabel\">" . $ingredient->getLabel() . "</td>
                                    
                                    <td>
                                       <input type=\"checkbox\" id=\"" . $ingredient->getLabel() . "\" name=\"" . $ingredient->getLabel() . "\">
                                       <label for=\"" . $ingredient->getLabel() . "\">
                                    </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
            </form>
            <div class="postform"></div>
            <button class="btn btn-white addSandwich" type="submit" form="sandwichForm">Valider</button>
        </div>
        <span class="image main"><img src="assets/gif/3.gif" alt="" /></span>
    </section>
</article>

    <?php include 'footer.php';?>

