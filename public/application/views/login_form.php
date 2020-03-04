<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

    header("location: http://localhost/login/index.php/user_authentication/user_login_process");
}
?>
<head>
    <title>AnnoncIIE</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
}
?>
<?php
if (isset($message_display)) {
    echo "<div class='message'>";
    echo "<span style='margin-left: 35%'>$message_display</span>";
    echo "</div>";
}
?>
<div id="main">
    <div id="login">
        <h2>AnnoncIIE</h2>
        <hr/>
        <?php echo form_open('authentification/login'); ?>
        <?php
        echo "<div class='error_msg'>";
        if (isset($error_message)) {
            echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        ?>
        <center><label>Email :</label>
        <input type="text" name="email" id="email" placeholder="E-mail"/><br /><br />
        <label>Mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="**********"/><br/><br /></center>
        <input type="submit" value=" Connexion " name="submit"/><br />
        <center><a href="<?php echo base_url() ?>index.php/authentification/registration">S'inscrire sur AnnoncIIE</a></center>
        <?php echo form_close(); ?>
    </div>
</div>
</body>
</html>