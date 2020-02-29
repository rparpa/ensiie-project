<?php

require_once '../src/Bootstrap.php';

$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($userService->userLoginCheck($_POST['pseudo'], $_POST['password']));
    {
        $currentUser = $userService->getUser($_POST['pseudo'], $_POST['password']);
        $userService->rememberUser($currentUser->getId(), $currentUser->getPseudo());
    }
}

?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <?php
    if ($userRepository->isLogged())
    {
        echo "logged";
    }
    else
    {

    }
    ?>
    <h3>Ok</h3>
</div>
</body>
</html>