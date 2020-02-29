<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $nom = ($this->session->userdata['logged_in']['nom']);
    $prenom = ($this->session->userdata['logged_in']['prenom']);
    $email = ($this->session->userdata['logged_in']['email']);
} else {
    header("location: login");
}
?>
<head>
    <title>Utilisateur Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="profile">
    <?php
    echo "Hello <b id='welcome'><i>" . $nom." ".$prenom . "</i> !</b>";
    echo "<br/>";
    echo "<br/>";
    echo "Welcome to USER Page";
    echo "<br/>";
    echo "<br/>";
    echo "Your Email is " . $email;
    echo "<br/>";
    ?>
    <b id="logout"><a href="logout">Déconnexion</a></b>
</div>
<br/>
<h1>PARTIE PROFIL...</h1>
</body>
</html>