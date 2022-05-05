<?php

use auth\JWT;
use models\NotificationSwap;
use Db\Connection;
use Db\ItemManager;
use Db\NotificationManager;


include "../../../vendor/autoload.php";

header('Content-type: application/json');
$jwt = new JWT();
echo json_encode((new NotificationManager(Connection::get()))->findAllByUserMail($jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"]),
    JSON_UNESCAPED_UNICODE);