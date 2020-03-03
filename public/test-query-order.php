<?php

require_once '../src/Bootstrap.php';

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use Ingredient\IngredientRepository;
use Ingredient\IngredientService;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;
use User\UserRepository;

$my_connection = \Db\Connection::get();
$orderService = new OrderService(
                    new OrderRepository($my_connection),
                    new SandwichRepository($my_connection),
                    new UserRepository($my_connection)
                );
$ingredientService = new IngredientService(new IngredientRepository($my_connection));

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $newOrder = new Order();
    
    $newSandwich = new Sandwich();
    $newSandwich->setLabel('test');
    $newSandwichs = [];
    $newSandwichs[] = $newSandwich;

    $userClient = new \User\User();
    $userValidator = new \User\User();

    $userRepository = new \User\UserRepository($my_connection);
    $userClient = $userRepository->findOneById(1);
    $userValidator = $userRepository->findOneById(2);

    $newOrder
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($newSandwichs)
            ->setClient($userClient);
    $newOrder->setValidator($userValidator);

    #create example
    $newOrder = $orderService->createOrder($newOrder);

    #delete example
    $orderService->deleteOrder($newOrder);

    #get all example
    $orders = $orderService->getAllOrders();
    $ingredients = $ingredientService->getAvailableIngredients();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredients = $ingredientService->getAvailableIngredients();

    $filterIngredients = [];
    foreach ($ingredients as $ingredient) {
        if(isset($_POST[$ingredient->getLabel()])) {
            $filterIngredients[] = $ingredient;
        }
    }

    $newSandwich = new Sandwich();
    $newSandwich
        ->setLabel($_POST["label"])
        ->setIngredients($filterIngredients);
    $newSandwichs = [];
    $newSandwichs[] = $newSandwich;

    $newOrder = new Order();
    $newOrder
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-05'))
            ->setSandwichs($newSandwichs);
    
    $orderService->createOrder($newOrder);
    
    $orders = $orderService->getAllOrders();
}

?>
<html>
<head>
    <title>Order Query</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">

    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Id</td>
    <td>Date</td>
    <td>Approval</td>
    <td>Sandwichs</td>
    </thead>
    <?php
    foreach ($orders as $order) : ?>
        <tr>
            <td></td>
            <td><?php echo $order->getId() ?></td>
            <td><?php echo $order->getDate()->format("Y-m-d") ?></td>
            <td><?php echo $order->getApproval() ? 'true' : 'false' ?></td>
            <td><?php
                foreach ($order->getSandwichs() as $ihmSandwich)
                {
                    echo $ihmSandwich->getLabel();
                    echo ' : ';
                    foreach ($ihmSandwich->getIngredients() as $ihmIngredient)
                    {
                        echo $ihmIngredient->getLabel();
                        echo ' , ';
                    }
                    echo '<br>';
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