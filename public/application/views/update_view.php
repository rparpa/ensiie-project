 <div>
        <h2>Modification du compte</h2>
        <hr/>
        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";
        echo form_open('utilisateur/update');
        echo form_hidden('id_user',$user[0]['id_user']);
        echo form_label('Nom : ');

        echo form_input('nom',$user[0]['nom']);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Prénom: ');
        echo form_input('prenom',$user[0]['prenom']);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Pseudo: ');
        echo form_input('pseudo',$user[0]['pseudo']);
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
            'value' => $user[0]['email']
        );
        echo form_input($data);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Telephone: ');
        echo form_input('telephone',$user[0]['telephone']);
        echo"<br/>";
        echo"<br/>";
        echo form_label('promo: ');

        echo form_dropdown('promo',['1A'=>'1A','2A'=>'2A','3A'=>'3A'],'1A');
        echo"<br/>";
        echo"<br/>";
        echo form_submit('submit', 'Modifier');
        echo form_close();
        ?>
    </div>