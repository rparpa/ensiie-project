<?php

use Db\Connection;
use Db\TokenManager;

include "../../../vendor/autoload.php";

$isValidToken = false;
if (isset($_GET['token'])) {
    $isValidToken = (new TokenManager(Connection::get()))->findByToken($_GET['token']) != null;
}
echo $isValidToken ? "true": "false";