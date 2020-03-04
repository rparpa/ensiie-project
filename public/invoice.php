<?

require_once '../src/Bootstrap.php';

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use Ingredient\IngredientRepository;
use Ingredient\IngredientService;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;
use User\UserRepository;
use Invoice\InvoiceRepository;
use User\User;
use User\UserService;

$my_connection = \Db\Connection::get();

$sandwichRepository = new SandwichRepository($my_connection);

$orderService = new OrderService(
    new OrderRepository($my_connection),
    $sandwichRepository,
    new UserRepository($my_connection),
    new InvoiceRepository($my_connection)
);
$ingredientService = new IngredientService(new IngredientRepository($my_connection));
$userService = new UserService(new \User\UserRepository($my_connection));

$availableIngredients = $ingredientService->getAvailableIngredients();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newSandwich = new Sandwich();
    $newSandwich->setLabel('Custom');

    $filterIngredients = [];
    foreach ($availableIngredients as $ingredient) {
        if(isset($_POST[$ingredient->getLabel()])) {
            $filterIngredients[] = $ingredient;
        }
    }

    $newSandwich->setIngredients($filterIngredients);
    $sandwichRepository->createSandwich($newSandwich);

    $userClient = new User();
    if(isset($_COOKIE['id'])){
        $userClient = $userService->getUserById($_COOKIE['id']);
    } else {
        $userClient = $userService->getUserById(1);
    }

    $newOrder = new Order();

    if(!isset($_SESSION['order_id'])) {

        $sandwichList = [];
        $sandwichList[] = $newSandwich;

        $newOrder
            ->setApproval(true) //@TODO tobe fix backen impossible d'insert en false + aucune erreur
            ->setDate(new DateTimeImmutable(date('d-m-Y')))
            ->setSandwichs($sandwichList)
            ->setClient($userClient);

        $orderService->createOrder($newOrder);

        $_SESSION["order_id"] = $newOrder->getId(); //save
    } else {
        $newOrder = $orderService->getOrderById($_SESSION['order_id']);
        //add new sandwich
    }
}

?>

<?php include 'header.php';?>

<!-- Main -->
<div id="main">

<!-- Recap -->
<article id="invoice">

    <h2 class="major">Validation</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>Sandwich</th>
                <th>Extra</th>
                <th>Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tabvalidation">
            <?
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                foreach ($newOrder->getSandwichs() as $sandwich) {
                    $price = 0;
                    $description = "";
                    $ingredients = $sandwich->getIngredients();
                    if ($ingredients != null) {
                        foreach ($ingredients as $ingredient) {
                            $price += $ingredient->getPrice();
                            $description .= $ingredient->getLabel() . "<br>";
                        }
                    }

                    echo "<tr>
                            <td>
                                <div class=\"sandwich\">" . $sandwich->getLabel() . "
                                    <div id=\"tooltip\">" . $description . "</div>
                                </div>
                            </td>
                            <td>Pas d'extra</td>
                            <td>" . $price . " €</td>
                            <td class=\"min\"><i class=\"fas fa-times\"></i></td>
                        </tr>
                        ";

                }
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    <a id="add" href="order.php" class="fas fa-plus"></a>
                </td>
                <td><? if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo $newOrder->getTotalPrice();
                    } ?> €</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <form action="pay.php" id="sandwichListForm" method="POST">
        <?
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $newOrder->getId();
            $id = 1; //Wait until debug
            echo "<input type=\"text\" name=\"id\" style=\"display: none;\" value=\"" . $id . "\" \">";
        }
        ?>
    </form>
    <button type="submit" class="button primary validation" form="sandwichListForm">Payer</button>

    <p><i id="disclaimer">La SandwicherIIE est une projet à but non lucratif, tous les aliments sont au prix coutant.</i></p>
</article>

<?php include 'footer.php';?>