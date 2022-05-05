<?php

use Db\Connection;
use Db\SwapManager;
use Db\TokenManager;

include "../../../vendor/autoload.php";
header('Content-type: application/json');
$swapManager = new SwapManager(Connection::get());

if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}
echo json_encode($swapManager->getStatistiquesLastSevenDays(), JSON_UNESCAPED_UNICODE);

