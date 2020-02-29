<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/login/index.php/user_authentication/user_login_process");
}
?>
<head>
    <title>page d'inscription</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="main">
    <div id="inscription">
        <h2>Inscription</h2>
        <hr/>
        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";
        echo form_open('authentification/registration');

        echo form_label('Nom : ');

        echo form_input('nom');
        echo"<br/>";
        echo"<br/>";
        echo form_label('Prénom: ');
        echo form_input('prenom');
        echo"<br/>";
        echo"<br/>";
        echo form_label('Pseudo: ');
        echo"<br/>";
        echo"<br/>";
        echo form_input('pseudo');
        echo "<div class='error_msg'>";
        if (isset($message_display)) {
            echo $message_display;
        }

        echo "</div>";
        echo"<br/>";
        echo form_label('Email : ');
        echo"<br/>";
        $data = array(
            'type' => 'email',
            'name' => 'email'
        );
        echo form_input($data);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Telephone: ');
        echo"<br/>";
        echo form_input('telephone');
        echo"<br/>";
        echo"<br/>";
        echo form_label('promo: ');

        echo form_dropdown('promo',['1A'=>'1A','2A'=>'2A','3A'=>'3A'],'1A');
        echo"<br/>";
        echo"<br/>";
        echo form_label('Password : ');
        echo"<br/>";
        echo form_password('password');
        echo"<br/>";
        echo"<br/>";
        echo form_submit('submit', 's\'inscrire');
        echo form_close();
        ?>
        <center><a href="<?php echo base_url()."authentification" ?> ">page de connexion</a></center>
    </div>
</div>
</body>
</html>