
<?php include 'header.php';?>

<!-- Recap -->
<article id="recap">

    <?

    use Order\Order;
    use Sandwich\Sandwich;
    use User\User;

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

        $sandwichList[] = $newSandwich;

        $userClient = new User();
        $userClient = $userService->getUserById(1);
        //@TODO get user

        $newOrder = new Order();
        $newOrder
            ->setApproval(false)
            ->setDate(new DateTimeImmutable(date('d-m-Y')))
            ->setSandwichs($sandwichList)
            ->setClient($userClient);

        $orderService->createOrder($newOrder);
        //$_SESSION['sandwichList'] = $sandwichList;
        echo $newOrder->getId();
    }
    ?>



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
                foreach ($sandwichList as $sandwich) {
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
                    <a id="add" href="#commander" class="fas fa-plus"></a>
                </td>
                <td><? if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo $newOrder->getTotalPrice();
                    } ?> €</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <form action="#pay" id="sandwichListForm" method="POST">
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