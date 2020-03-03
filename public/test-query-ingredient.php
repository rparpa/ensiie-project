<?php

require_once '../src/Bootstrap.php';

use Ingredient\Ingredient;
use Ingredient\IngredientRepository;
use Ingredient\IngredientService;

$ingredientService = new IngredientService(
                            new IngredientRepository(\Db\Connection::get())
                        );

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $errorId = '';
    $errorLabel = '';
    $errorPrice = '';

    $newIngredient = new Ingredient();
    $newIngredient
            ->setLabel('test')
            ->setAvailable(true)
            ->setPrice(2.0);

    #create example
    $newIngredient = $ingredientService->saveIngredient($newIngredient);

    $newIngredient->setLabel('final_test');
    #update example
    $ingredientService->saveIngredient($newIngredient);

    #delete example
    $ingredientService->deleteIngredient($newIngredient);

    #get all example
    $ingredients = $ingredientService->getAllIngredients();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $newIngredient = new Ingredient();

    if (!empty($_POST["id"]))
        $newIngredient->setId($_POST["id"]);

    $newIngredient
        ->setLabel($_POST["label"])
        ->setAvailable(isset($_POST["available"]))
        ->setPrice(($_POST["price"]));

    $ingredientService->saveIngredient($newIngredient);

    $errorId = isset($ingredientService->getErrors()['id']) ? $ingredientService->getErrors()['id'] : '';
    $errorLabel = isset($ingredientService->getErrors()['label']) ? $ingredientService->getErrors()['label'] : '';
    $errorPrice = isset($ingredientService->getErrors()['price']) ? $ingredientService->getErrors()['price'] : '';

    $ingredients = $ingredientService->getAllIngredients();

}

?>
<html>
<head>
    <title>Ingredient Query</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">

    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Id</td>
    <td>Label</td>
    <td>Available</td>
    <td>Price</td>
    </thead>
    <?php
    foreach ($ingredients as $ingredient) : ?>
        <tr>
            <td></td>
            <td><?php echo $ingredient->getId() ?></td>
            <td><?php echo $ingredient->getLabel() ?></td>
            <td><?php echo $ingredient->getAvailable() ? 'true' : 'false' ?></td>
            <td><?php echo $ingredient->getPrice() ?> $ </td>
        </tr>
    <?php endforeach; ?>

    <?php echo $errorId ?>
    <?php echo $errorLabel ?>
    <?php echo $errorPrice ?>

    </table>

    <form action="" method="POST">
        <label for="id">Id :</label><br>
        <input type="number" id="id" name="id"><br>

        <label for="label">Label :</label><br>
        <input type="text" id="label" name="label"><br>

        <label for="available">Available :</label><br>
        <input type="checkbox" id="available" name="available" value="1"><br>

        <label for="price">Price :</label><br>
        <input type="number" step="any" id="price" name="price"><br>

        <input id="saveButton" type="submit" value="Sauvegarder"><br>
    </form>
    

  </div>
  <script>
      document.getElementById("saveButton").onclick = function() {
        console.log(
            "id : " + document.getElementById("id").value + "\n" +
            "label : " + document.getElementById("label").value + "\n" +
            "checkox : " + document.getElementById("available").checked + "\n" +
            "price : " + document.getElementById("price").value
        );
      };
  </script>  
</body>
</html>