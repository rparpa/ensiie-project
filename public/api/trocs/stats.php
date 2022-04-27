<?php

use Db\Connection;
use Db\SwapManager;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
header('Content-type: application/json');
$swapManager = new SwapManager(Connection::get());
echo json_encode($swapManager->getStatistiquesLastSevenDays(), JSON_UNESCAPED_UNICODE);

