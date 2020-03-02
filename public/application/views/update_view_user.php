<h2><center>Modifier mon compte </center></h2>
<hr/>
<div id="main" style="margin-left: 37%;width : 30%">

        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";
        echo form_open('utilisateur/update',['class'=>'text-center border border-light p-5']);
        echo form_hidden('id_user',$user[0]['id_user']);
        echo form_label('Nom : ');
        echo form_input(array(
            'name' => 'nom',
            'id' => 'nom',
            'value' => $user[0]['nom'],
            'class'=>"form-control sm-4"
        ));
        echo"<br/>";
        echo"<br/>";
        echo form_label('Prénom: ');
        echo form_input(array(
            'name' => 'prenom',
            'id' => 'prenom',
            'value' => $user[0]['prenom'],
            'class'=>"form-control sm-4"
        ));
        echo"<br/>";
        echo"<br/>";
        echo form_label('Pseudo: ');
        echo form_input(array(
            'name' => 'pseudo',
            'id' => 'pseudo',
            'value' => $user[0]['pseudo'],
            'class'=>"form-control sm-4"
        ));
        echo "<div class='error_msg'>";
        if (isset($message_display)) {
            echo $message_display;
        }

        echo "</div>";
        echo"<br/>";
        echo form_label('Email : ');
        $data = array(
            'type' => 'email',
            'name' => 'email',
            'value' => $user[0]['email'],
            'class'=>"form-control sm-4"
        );
        echo form_input($data);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Telephone: ');
        echo form_input(array(
            'name' => 'telephone',
            'id' => 'telephone',
            'value' => $user[0]['telephone'],
            'class'=>"form-control sm-4"
        ));
        echo"<br/>";
        echo"<br/>";
        echo form_label('promo: ')."</br>";
        echo form_dropdown('promo',['1A'=>'1A','2A'=>'2A','3A'=>'3A'],$user[0]['promo']);
        echo"<br/>";
        echo"<br/>";
        echo form_label('nombre des signals: ');

        echo form_input(array(
            'name' => 'nb_signal_user',
            'id' => 'nb_signal_user',
            'value' => $user[0]['nb_signal_user'],
            'class'=>"form-control sm-4",
            'readonly'=>'readonly'
        ));
        echo"<br/>";
        echo"<br/>";
        echo "<div style='width: 70%;margin-left: 15%'>";
        echo form_submit('submit', 'Modifier',['class'=>"btn btn-success btn-block"]);
        echo "</div>";

        echo form_close();
        ?>
        </div>
