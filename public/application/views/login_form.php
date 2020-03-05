<html>
    <head>
        <title>AnnoncIIE</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
        <link href="../../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- JS -->
        <script src="../../../assets/jquery/jquery.min.js" type="text/javascript" ></script>
        <script src="../../../assets/js//bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <?php
                if($this->session->flashdata('message')!=null)
                    echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('message').'</div>';
                if($this->session->flashdata('error')!=null)
                    echo '<div class="alert alert-danger alert-dismissible fade-show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('error').'</div>';
            ?>
            
            <div class="h-100 row align-items-center">
                <div class="col-md-5 mx-auto ">
                    <div class="card">
                        <h3 class="card-header text-white text-center bg-dark">AnnoncIIE</h3>
                        <div class="card-body">
                            <?php echo form_open('authentification/login'); ?>
                            <?php
                                echo "<div class='error_msg'>";
                                echo validation_errors();
                                echo "</div>";
                                echo form_label("Email :", 'email','class="control-label"');
                                echo form_input("email","",array('id'=>'email','placeholder'=>'Entrez votre email ...'));
                                echo '<br /><br />';
                                echo form_label("Mot de passe :", 'password','class="control-label"');
                                echo form_password("password","",array('id'=>'password','placeholder'=>'Entrez votre mot de passe ...'));
                                echo '<br /><br />';
                                echo form_submit("submit","Connexion");
                            ?>
                              <center><a href="<?php echo base_url() ?>index.php/authentification/registration">Pas encore inscrit ? C'est ici !</a></center>
                            <?php
                                echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
        </div>

    </body>
</html>