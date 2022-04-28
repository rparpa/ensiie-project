<?php

use auth\JWT;
use Db\Connection;
use Db\ItemManager;


include "../../../vendor/autoload.php";
require_once "../../../src/templates/template-factory.php";

header('Content-type: application/json');
$jwt = new JWT();
echo json_encode((new ItemManager(Connection::get()))->findAllByProprietaryMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]),
    JSON_UNESCAPED_UNICODE);

