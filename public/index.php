<?php

use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use Ingredient\IngredientRepository;
use Ingredient\IngredientService;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;


require_once '../src/Bootstrap.php';


$my_connection = \Db\Connection::get();
$userRepository = new \User\UserRepository(\Db\Connection::get());
$userService = new \User\UserService($userRepository);

$ingredientService = new IngredientService(new IngredientRepository($my_connection));
$sandwichRepository = new SandwichRepository($my_connection);

$orderService = new OrderService(
    new OrderRepository($my_connection),
    new SandwichRepository($my_connection)
);


$sandwichList = [];/*
if(isset($_SESSION['sandwichList'])){
    //$sandwichList = 0;
}*/

$availableIngredients = $ingredientService->getAvailableIngredients();

$users = $userService->getAllUser();
?>

<!DOCTYPE HTML>

<html>
	<head>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>	
		<script type="text/javascript" src="./index.js"></script>
		<title>SandwicherIIE</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
			<div id="wrapper">
					<header id="header">
						<div class="logo">
							<img src="images/logo.png" width="80%"></img>
						</div>
						<div class="content">
							<div class="inner">
								<h1>La SandwicherIIE</h1>
								<p>L'association Sandwich de l'ENSIIE, commandez votre menu avec nous</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#connexion">Connexion</a></li>
								<?php if(isset($_POST['pseudo']))  echo
								'<li><a href="#commander">Commander</a></li>
								<li><a href="#contact">Contact</a></li>
								<li><a href="#elements">Elements</a></li>'?>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- connexion -->
							<article id="connexion">
							<section>
									<h3 class="major">Connexion</h3>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="pseudo">Pseudo</label>
												<input type="text" name="pseudo" id="pseudo" value="" placeholder="Snitchy" />
											</div>
											<div class="field half">
												<label for="password">Mot de passe</label>
												<input type="password" name="password" id="password" value="" placeholder="**********" autocomplete="off" />
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Connexion" class="primary" /></li>

										</ul>
										<ul class="actions">
											<a class="primary" href="#CreerCompte">Créer un compte</a>
										</ul>
									</form>
								</section></article>

							<article id="CreerCompte">
							<section>
									<h3 class="major">Création de compte</h3>
									<form name="CreateAccount" method="post" action="#">
										<div class="fields">
											<div class="field thrid">
												<label for="pseudo">Pseudo</label>
												<input type="text" name="pseudo" id="pseudo" value="" placeholder="Snitchy" />
											</div>
											<div class="field half">
												<label for="newmdp">Mot de passe</label>
												<input type="password" name="newmdp" id="newmdp" value="" placeholder="**********" autocomplete="off" />
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

						<!-- commander -->
							<article id="commander">
								<h1 class="major">Commander</h1>

								<section>
									<h3 class="major">Pimp my sandwich</h3>
									<div class="table-wrapper">
										<table class="alt customSandwich">
											<thead>
												<tr>
													<th>Ingrédient</th>
													<th>Description</th>
													<th>Ajouter</th>
												</tr>
											</thead>
											<tbody>
                                                <form action="#recap" id="sandwichForm" method="POST">

                                                    <?

                                                    foreach ($availableIngredients as $ingredient) {

                                                        echo "<tr class=\"item\">
                                                                    <td>
                                                                        <img src=\"images/Salade.jpg\" width=\"50%\" alt=\"\" style=\"vertical-align: middle\"/>
                                                                    </td>
                                                                    
                                                                    <td class=\"ingredLabel\">" . $ingredient->getLabel() . "</td>
                                                                    
                                                                    <td>
                                                                       <input type=\"checkbox\" id=\"" . $ingredient->getLabel() . "\" name=\"" . $ingredient->getLabel() . "\">
                                                                       <label for=\"" . $ingredient->getLabel() . "\">
                                                                    </td>
                                                              </tr>";
                                                    }
                                                    ?>
                                                </form>
											</tbody>
										</table>
                                        <div class="postform"></div>
                                        <button class="btn btn-white addSandwich" type="submit" form="sandwichForm">Valider</button>
									</div>
									<span class="image main"><img src="assets/gif/3.gif" alt="" /></span>
								</section>
								</article>

						<!-- Contact -->
							<article id="contact">
								<h2 class="major">Contact</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="4"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
								</ul>
							</article>


                        <!-- Recap -->
                        <article id="recap">

                            <?
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $newSandwich = new Sandwich();
                                $newSandwich->setLabel('Custom');

                                $filterIngredients = [];
                                foreach ($availableIngredients as $ingredient) {
                                    if(isset($_POST[$ingredient->getLabel()])) {
                                        $filterIngredients[] = $ingredient;
                                    }
                                }

                                $newSandwich->setIngredients($filterIngredients);
                                $sandwichRepository->createSandwich($newSandwich);

                                $sandwichList[] = $newSandwich;


                                $newOrder = new Order();
                                $newOrder
                                    ->setApproval(false)
                                    ->setDate(new DateTimeImmutable(date('d-m-Y')))
                                    ->setSandwichs($sandwichList);

                                $orderService->createOrder($newOrder);
                                //$_SESSION['sandwichList'] = $sandwichList;
                                echo $newOrder->getId();
                            }
                            ?>



                            <h2 class="major">Validation</h2>
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Sandwich</th>
                                            <th>Extra</th>
                                            <th>Prix</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tabvalidation">
                                        <?
                                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            foreach ($sandwichList as $sandwich) {
                                                $price = 0;
                                                $description = "";
                                                $ingredients = $sandwich->getIngredients();
                                                if ($ingredients != null) {
                                                    foreach ($ingredients as $ingredient) {
                                                        $price += $ingredient->getPrice();
                                                        $description .= $ingredient->getLabel() . "<br>";
                                                    }
                                                }

                                                echo "<tr>
                                                        <td>
                                                            <div class=\"sandwich\">" . $sandwich->getLabel() . "
                                                                <div id=\"tooltip\">" . $description . "</div>
                                                            </div>
                                                        </td>
                                                        <td>Pas d'extra</td>
                                                        <td>" . $price . " €</td>
                                                        <td class=\"min\"><i class=\"fas fa-times\"></i></td>
                                                    </tr>
                                                    ";

                                            }
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <a id="add" href="#commander" class="fas fa-plus"></a>
                                            </td>
                                            <td><? if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                                    echo $orderService->getTotalPrice($newOrder);
                                                } ?> €</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                    <form action="#pay" id="sandwichListForm" method="POST">
                                        <?
                                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            $id = $newOrder->getId();
                                            $id = 1; //Wait until debug
                                            echo "<input type=\"text\" name=\"id\" style=\"display: none;\" value=\"" . $id . "\" \">";
                                        }
                                        ?>
                                    </form>
                                    <button type="submit" class="button primary validation" form="sandwichListForm">Payer</button>

                            <p><i id="disclaimer">La SandwicherIIE est une projet à but non lucratif, tous les aliments sont au prix coutant.</i></p>
                        </article>


                        <!-- Pay -->
                        <article id="pay">
                            <h2 class="major">Validation</h2>

                            <div class="f-modal-alert">
                                <div class="f-modal-icon f-modal-success animate">
                                    <span class="f-modal-line f-modal-tip animateSuccessTip"></span>
                                    <span class="f-modal-line f-modal-long animateSuccessLong"></span>
                                    <div class="f-modal-placeholder"></div>
                                    <div class="f-modal-fix"></div>
                                </div>
                            </div>
                            <?
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                                $newOrder = $orderService->getOrderById($_POST['id']);

                               echo "
                                <p class=\"align-center\"> Merci pour votre commande #" . $newOrder->getId() . "<br>Etat de la commande : " . $newOrder->getApproval() . "<br>" . $newOrder->getDate()->format("Y-m-d") . "</p>
                                ";
                            }
                            $fi = new FilesystemIterator('assets/gif', FilesystemIterator::SKIP_DOTS);
                            $r = rand(2, iterator_count($fi)+1);
                            $file = scandir('assets/gif');

                            echo "<img class=\"img-center gif\" src=\"assets/gif/" . $file[$r] . "\"/>";
                            ?>

                            <p><i id="disclaimer">La SandwicherIIE est une projet à but non lucratif, tous les aliments sont au prix coutant.</i></p>
                        </article>

						<!-- Elements -->
							<article id="elements">
								<h2 class="major">Elements</h2>

								<section>
									<h3 class="major">Text</h3>
									<p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
									This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
									This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
									<hr />
									<h2>Heading Level 2</h2>
									<h3>Heading Level 3</h3>
									<h4>Heading Level 4</h4>
									<h5>Heading Level 5</h5>
									<h6>Heading Level 6</h6>
									<hr />
									<h4>Blockquote</h4>
									<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
									<h4>Preformatted</h4>
									<pre><code>i = 0;

while (!deck.isInOrder()) {
    print 'Iteration ' + i;
    deck.shuffle();
    i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
								</section>

								<section>
									<h3 class="major">Lists</h3>

									<h4>Unordered</h4>
									<ul>
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>

									<h4>Alternate</h4>
									<ul class="alt">
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>

									<h4>Ordered</h4>
									<ol>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis viverra.</li>
										<li>Felis enim feugiat.</li>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis lorem.</li>
										<li>Felis enim et feugiat.</li>
									</ol>
									<h4>Icons</h4>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
									</ul>

									<h4>Actions</h4>
									<ul class="actions">
										<li><a href="#" class="button primary">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
									<ul class="actions stacked">
										<li><a href="#" class="button primary">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
								</section>

								<section>
									<h3 class="major">Table</h3>
									<h4>Default</h4>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One qzdqsd  qsd d q  ss dqsdqsd</td>
													<td>Ante turpis</td>
													<td>29.99 zer seqfeqssqdf qfqs fsfdfdf</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>

									<h4>Alternate</h4>
									<div class="table-wrapper">
										<table class="alt">
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</section>

								<section>
									<h3 class="major">Buttons</h3>
									<ul class="actions">
										<li><a href="#" class="button primary">Primary</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button">Default</a></li>
										<li><a href="#" class="button small">Small</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button primary icon solid fa-download">Icon</a></li>
										<li><a href="#" class="button icon solid fa-download">Icon</a></li>
									</ul>
									<ul class="actions">
										<li><span class="button primary disabled">Disabled</span></li>
										<li><span class="button disabled">Disabled</span></li>
									</ul>
								</section>

								<section>
									<h3 class="major">Form</h3>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="demo-name">Name</label>
												<input type="text" name="demo-name" id="demo-name" value="" placeholder="Jane Doe" />
											</div>
											<div class="field half">
												<label for="demo-email">Email</label>
												<input type="email" name="demo-email" id="demo-email" value="" placeholder="jane@untitled.tld" />
											</div>
											<div class="field">
												<label for="demo-category">Category</label>
												<select name="demo-category" id="demo-category">
													<option value="">-</option>
													<option value="1">Manufacturing</option>
													<option value="1">Shipping</option>
													<option value="1">Administration</option>
													<option value="1">Human Resources</option>
												</select>
											</div>
											<div class="field half">
												<input type="radio" id="demo-priority-low" name="demo-priority" checked>
												<label for="demo-priority-low">Low</label>
											</div>
											<div class="field half">
												<input type="radio" id="demo-priority-high" name="demo-priority">
												<label for="demo-priority-high">High</label>
											</div>
											<div class="field half">
												<input type="checkbox" id="demo-copy" name="demo-copy">
												<label for="demo-copy">Email me a copy</label>
											</div>
											<div class="field half">
												<input type="checkbox" id="demo-human" name="demo-human" checked>
												<label for="demo-human">Not a robot</label>
											</div>
											<div class="field">
												<label for="demo-message">Message</label>
												<textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Send Message" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</form>
								</section>
							</article>

					</div>

				<!-- Footer -->
					<footer id="footer">
					<?php if(isset($_POST['pseudo'])) echo 'Connecté en tant que : ' . $_POST['pseudo']; ?>
						<p class="copyright">&copy; SandwicherIIE <?php echo date("Y"); ?></p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<SCRIPT TYPE="text/javascript">


            verify = new verifynotify();
            verify.field1 = document.CreateAccount.newmdp;
            verify.field2 = document.CreateAccount.newmdp2;
            verify.result_id = "password_result";
            verify.match_html = "Passwords match.";
            verify.nomatch_html = "Please make sure your passwords match.";

            // Update the result message
            verify.check();

            //
            </SCRIPT>

	</body>
</html>
