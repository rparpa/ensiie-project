<?php

use User\User;
use User\UserService;
use User\UserRepository;

require_once '../src/Bootstrap.php';


$my_connection = \Db\Connection::get();

$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userRepository = new \User\UserRepository(\Db\Connection::get());
    $userService = new \User\UserService($userRepository);
    $newUser = new \User\User();
    $newUser->setFirstname("Noel");
    $newUser->setLastname("Flantier");
    $newUser->setBirthday(new DateTimeImmutable("01/01/1965"));
    $newUser->setMail("bla@bla.fr");


    $newUser->setPseudo($_POST["pseudo"]);
    $newUser->setPassword($_POST["password"]);
    $userService->createUser($newUser);

    if($userService->userLoginCheck($_POST['pseudo'], $_POST['password']));
    {
        $currentUser = $userService->getUser($_POST['pseudo'], $_POST['password']);
        $userService->rememberUser($currentUser->getId(), $currentUser->getPseudo());
    }

    header("Location: /"); //to change
}

?>
<?php include 'header.php';?>

<!-- Main -->
<div id="main">

<article id="creation">
    <section>
        <h3 class="major">Création de compte</h3>

        <form name="CreateAccount" method="post" action="#">
										<div class="fields">
											<div class="field thrid">
												<label for="pseudo">Pseudo</label>
												<input type="text" name="pseudo" id="pseudo" value="" placeholder="Snitchy" />
											</div>
											<div class="field half">
												<label for="password">Mot de passe</label>
												<input type="password" name="password" id="password" value="" placeholder="**********" autocomplete="off" />
											</div>
											<div class="field half">
												<label for="newmdp2">Confirmation mot de passe</label>
												<input type="password" name="newmdp2" id="newmdp2" value="" placeholder="**********" autocomplete="off" />
											</div>

										</div>
										<div>
											<ul class="actions">
											<li><button name ="btnSignUp" id="btnSignUp" type="submit" value="Créer un compte" class="primary">Créer un compte</button></li>
											</ul>
										</div>
									</form>
        
    </section></article>

<?php include 'footer.php';?>