
    <div class='container'>

    <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";
        echo form_open('utilisateur/update',['class'=>'text-center border border-light p-5']);
        echo form_hidden('id_user',$user[0]['id_user']);

        
        echo '<div class="card">';
            
            echo '<h5 class="card-header float-left text-black bg-warning">Modifier informations personnels</h5>';
                
            echo '<div class="card-body">';
                echo '<div class="row">';
                
                    echo '<div class="col-md">';
                        echo form_label('Nom :&nbsp;', 'nom','class="control-label"');
                            echo form_input(array(
                                    'name' => 'nom',
                                    'id' => 'nom',
                                    'value' => $user[0]['nom'],
                                    'class'=>"form-control sm-4"
                                ));
                    echo '</div>';

                    echo '<div class="col-md">';
                        echo form_label('Prenom :&nbsp;', 'prenom','class="control-label"');
                        echo form_input(array(
                            'name' => 'prenom',
                            'id' => 'prenom',
                            'value' => $user[0]['prenom'],
                            'class'=>"form-control sm-4"
                        ));
                    echo '</div>';

                echo '</div>';


                echo"<br/>";
                echo"<br/>";

                echo '<div class="row">';
                    
                    echo '<div class="col-md">';
                        echo form_label('Pseudo :&nbsp;', 'pseudo','class="control-label"');
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
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="col-md">';
                        echo form_label('Email :&nbsp;', 'email','class="control-label"');
                            $data = array(
                                'type' => 'email',
                                'name' => 'email',
                                'value' => $user[0]['email'],
                                'class'=>"form-control sm-4",
                                'aria-describedby'=>"emailHelp",
                                'placeholder'=>"Entrez votre email"
                            );
                        echo form_input($data);
                    echo '</div>';

                echo '</div>';



                echo"<br/>";
                echo"<br/>";

                echo '<div class="row">';
                    
                    echo '<div class="col-md-3">';
                        echo form_label('Telephone :&nbsp;', 'telephone','class="control-label"');
                        echo form_input(array(
                            'name' => 'telephone',
                            'id' => 'telephone',
                            'value' => $user[0]['telephone'],
                            'class'=>"form-control sm-4"
                        ));
                    echo '</div>';

                    echo '<div class="col-md-2">';
                    echo form_label('Promo :&nbsp;', 'promo','class="control-label"');
                    echo form_dropdown('promo',['1A'=>'1A','2A'=>'2A','3A'=>'3A'],$user[0]['promo'],'class=custom-select');

                echo '</div>';

                echo '</div>';

                echo"<br/>";
                echo"<br/>";

                echo '<div class="row">';
                        
                    echo '<div class="col-md-3">';
                        echo form_label('Nombre de signal :&nbsp;', 'nb_signal_user','class="control-label"');
                        echo form_input(array(
                            'name' => 'nb_signal_user',
                            'id' => 'nb_signal_user',
                            'value' => $user[0]['nb_signal_user'],
                            'class'=>"form-control sm-4",
                            'readonly'=>'readonly'
                        ));
                    echo '</div>';

                echo '</div>';

                echo"<br/>";
                echo"<br/>";               

            echo '</div>';
        echo '</div>';
            echo"<br/>";
            echo form_submit('submit', 'Modifier',array('type'=>'button','class'=>"float-right btn btn-warning"));
        echo form_close();
        ?>
        </div>
