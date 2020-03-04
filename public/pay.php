<?php

require_once '../src/Bootstrap.php';

use Invoice\InvoiceRepository;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;
use Sandwich\SandwichRepository;
use User\UserRepository;

$my_connection = \Db\Connection::get();

$sandwichRepository = new SandwichRepository($my_connection);

$orderService = new OrderService(
    new OrderRepository($my_connection),
    $sandwichRepository,
    new UserRepository($my_connection),
    new InvoiceRepository($my_connection)
);

?>
<?php include 'header.php';?>


<!-- Main -->
<div id="main">

<!-- Pay -->
<article id="pay">
    <h2 class="major">Validation</h2>

    <div class="f-modal-alert">
        <div class="f-modal-icon f-modal-success animate">
            <span class="f-modal-line f-modal-tip animateSuccessTip"></span>
            <span class="f-modal-line f-modal-long animateSuccessLong"></span>
            <div class="f-modal-placeholder"></div>
            <div class="f-modal-fix"></div>
        </div>
    </div>
    <?
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $newOrder = $orderService->getOrderById($_POST['id']);

        echo "
                                <p class=\"align-center\"> Merci pour votre commande #" . $newOrder->getId() . "<br>Etat de la commande : " . $newOrder->getApproval() . "<br>" . $newOrder->getDate()->format("Y-m-d") . "</p>
                                ";
    }
    $fi = new FilesystemIterator('assets/gif', FilesystemIterator::SKIP_DOTS);
    $r = rand(2, iterator_count($fi)+1);
    $file = scandir('assets/gif');

    echo "<img class=\"img-center gif\" src=\"assets/gif/" . $file[$r] . "\"/>";
    ?>

    <p><i id="disclaimer">La SandwicherIIE est une projet à but non lucratif, tous les aliments sont au prix coutant.</i></p>
</article>

<?php include 'footer.php';?>
