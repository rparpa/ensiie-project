<?php

require_once '../src/Bootstrap.php';

$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);

setcookie("pseudo", "", time() - 3600);
setcookie("id", "", time() - 3600);

?>