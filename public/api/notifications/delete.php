<?php

use auth\JWT;
use Db\Connection;
use Db\ItemManager;
use Db\NotificationManager;


include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    header('Content-type: application/json');
    $jwt = new JWT();
    if (isset($_GET["mail"])
        && $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"] == $_GET["mail"]) {
        echo json_encode((new NotificationManager(Connection::get()))->deleteAllByMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]),
            JSON_UNESCAPED_UNICODE);
    }
}
