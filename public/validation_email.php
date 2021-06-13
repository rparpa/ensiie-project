<?php
    if(!isset($_GET['username'])){
        header('Location: /index.php');
    }
    require_once '../src/Bootstrap.php';
    $conn = \Db\Connection::get();
    $username = $_GET['username'];
    $sql = 'UPDATE public.User SET VALIDATE = TRUE WHERE username = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
?>

<!doctype html>

<html lang="fr">
 <?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html");?>
    <div id="email_message1" class="col-12">Merci d'avoir validé votre adresse email !</div>
    <div id="email_message2" class="col-12">Vous pouvez desormais vous connecter</div>
    <div id="email_text_pseudo" class="col-12"><b>Votre pseudo: </b><?php echo "<span id='email_username'>".$username."</span>"; ?></div>
    <div class="col-12 div_btn_back"><button onclick='window.location.replace("/index.php");' type="button" class="btn btn_back_from_validation">Retourner à la page d'accueil</button></div>
</body>

</html>