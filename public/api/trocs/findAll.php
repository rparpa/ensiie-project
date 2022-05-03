<?php

use auth\JWT;
use Db\Connection;
use Db\SwapManager;
use Db\TokenManager;

include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";
header('Content-type: application/json');
$swapManager = new SwapManager(Connection::get());
$result = null;
$jwt = new JWT();
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}
if (isset($_GET["mail"]) && isset($_GET["is_done"]) && $_GET["mail"] === $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]) {
    $result = $swapManager->findAllByIsDoneAndUserMail($_GET["mail"], $_GET["is_done"]);
} else if (isset($_GET["last-10"])) {
    $result = $swapManager->findAllOrderByEndDateDescLimit10();
} else {
    $result = $swapManager->findAll();
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

