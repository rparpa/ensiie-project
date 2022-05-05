<?php

use auth\JWT;
use Db\Connection;
use Db\SwapManager;
use Db\TokenManager;
use models\Swap;
use models\User;

include "../../../vendor/autoload.php";
$jwt = new JWT();
$swapJson = json_decode(file_get_contents('php://input'), true);
$swapToUpdate = new Swap($swapJson["id"],
    $swapJson["creation_date"],
    $swapJson["end_date"],
    $swapJson["is_done"],
    $swapJson["status"],
    new User($swapJson["user_from"]["email"],
        $swapJson["user_from"]["firstname"],
        $swapJson["user_from"]["lastname"],
        $swapJson["user_from"]["pseudo"],
        "",
        $swapJson["user_from"]["picture"],
        $swapJson["user_from"]["zipcode"],
        $swapJson["user_from"]["street"],
        $swapJson["user_from"]["city"],
        $swapJson["user_from"]["is_super_user"],
        $swapJson["user_from"]["is_banned"]
    ),
    new User($swapJson["user_to"]["email"],
        $swapJson["user_to"]["firstname"],
        $swapJson["user_to"]["lastname"],
        $swapJson["user_to"]["pseudo"],
        "",
        $swapJson["user_to"]["picture"],
        $swapJson["user_to"]["zipcode"],
        $swapJson["user_to"]["street"],
        $swapJson["user_to"]["city"],
        $swapJson["user_to"]["is_super_user"],
        $swapJson["user_to"]["is_banned"]
    ),
    $swapJson["items"]);
if ((new TokenManager(Connection::get()))->findByToken($_SERVER["HTTP_AUTHORIZATION"]) == null
    || ($swapToUpdate->getUserTo()->getMail() != $jwt->getPayload($_SERVER["HTTP_AUTHORIZATION"])["email"])) {
    header('HTTP/1.0 401 Unauthorized');
    die();
}

$swapUpdated = (new SwapManager(Connection::get()))->update($swapToUpdate);
echo json_encode($swapUpdated, JSON_UNESCAPED_UNICODE);