<h2><center>Modification du compte de l'utilisateur <?= "<b>".$user[0]['nom']." ".$user[0]['prenom']."</b>"?></center></h2>
<hr/>
<div id="main" style="margin-left: 37%;width : 30%">

        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";
        echo form_open('utilisateur/update',['class'=>'text-center border border-light p-5']);
        echo form_hidden('id_user',$user[0]['id_user']);
        echo form_label('nombre des signals: ');

        echo form_input(array(
            'name' => 'nb_signal_user',
            'id' => 'nb_signal_user',
            'value' => $user[0]['nb_signal_user'],
            'readonly' => 'readonly',
            'class'=>"form-control sm-4"
        ));
        echo"<br/>";
        echo"<br/>";
        echo form_label('droit de publication: ');
        echo"<br/>";
        $bol="Oui";
        if(!$user[0]['droit_publication'])
        {
            $bol="Non";
        }
        echo form_dropdown('droit_publication',['true'=>'Oui','false'=>'Non'],!$user[0]['droit_publication']);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Administrateur :');
        echo"<br/>";
        $bolAdmin="Non";
        if($user[0]['admin'])
        {
                $bolAdmin="Oui";
        }
        echo form_dropdown('admin',['true'=>'Oui','false'=>'Non'],!$user[0]['admin']);
        echo"<br/>";
        echo"<br/>";
        echo "<div style='width: 70%;margin-left: 15%'>";
        echo form_button('reinitial', 'reinitialiser le nombre des signals',['class'=>"btn btn-warning btn-blo ck",'onClick'=>"hello()"]);
        echo form_submit('submit', 'Modifier',['class'=>"btn btn-success btn-block"]);
        echo "</div>";

        echo form_close();
        ?>

 <script>
         function hello() {
                 document.getElementById("nb_signal_user").value = "0";
                 alert("nombre de signals est réinitialisé");
         }
 </script>
        </div>
