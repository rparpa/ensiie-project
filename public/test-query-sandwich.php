<?php

require_once '../src/Bootstrap.php';

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use Ingredient\IngredientRepository;

$sandwichRepository = new SandwichRepository(\Db\Connection::get());
$ingredientRepository = new IngredientRepository(\Db\Connection::get());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $newSandwich = new Sandwich();

    $newSandwich->setLabel('test');

    #create example
    $sandwichRepository->createSandwich($newSandwich);

    #get all example
    $sandwichs = $sandwichRepository->getAll();

    $newSandwich->setId(end($sandwichs)->getId());
    #delete example
    $sandwichRepository->deleteSandwich($newSandwich);

    $sandwichs = $sandwichRepository->getAll();
    $ingredients = $ingredientRepository->fetchAll();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredients = $ingredientRepository->fetchAll();
    $newSandwich = new Sandwich();

    $filterIngredients = [];
    foreach ($ingredients as $ingredient) {
        
        if($ingredient->getAvailable() == true) {
            if(isset($_POST[$ingredient->getLabel()])) {
                $filterIngredients[] = $ingredient;
            }
        }
    }

    $newSandwich
        ->setLabel($_POST["label"])
        ->setIngredients($filterIngredients);

    $sandwichRepository->createSandwich($newSandwich);



    $sandwichs = $sandwichRepository->getAll();
    $ingredients = $ingredientRepository->fetchAll();
}

?>
<html>
<head>
    <title>Sandwich Query</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">

    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Id</td>
    <td>Label</td>
    <td>Ingredients</td>
    </thead>
    <?php
    foreach ($sandwichs as $sandwich) : ?>
        <tr>
            <td></td>
            <td><?php echo $sandwich->getId() ?></td>
            <td><?php echo $sandwich->getLabel() ?></td>
            <td><?php 
                foreach ($sandwich->getIngredients() as $ihmIngredient) {
                    echo $ihmIngredient->getLabel();
                    echo ' , ';
                }
            ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

    <form action="" method="POST">

        <label for="label">Label :</label><br>
        <input type="text" id="label" name="label"><br>
        <?php
        foreach ($ingredients as $ingredient) : ?>
                <label for="<?php echo $ingredient->getLabel() ?>"><?php echo $ingredient->getLabel() ?> :</label>
                <input type="checkbox" id="<?php echo $ingredient->getLabel() ?>" name="<?php echo $ingredient->getLabel() ?>" value="<?php echo $ingredient->getId() ?>"><br>
        <?php endforeach; ?>
        <input id="saveButton" type="submit" value="Sauvegarder"><br>
    </form>

  </div> 
</body>
</html>