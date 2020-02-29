<?php

use Db\Connection;
use User\User;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';

$userrepository =
    new UserRepository(Connection::get(), new UserHydrator());

?>
    <div class="mx-auto">
        <div align="center" class="row">
            <div class="col">
                <label for="select-user-add">Selectionner un utilisateur</label>
                <select id="select-user-add" onchange="LoadFormualire()">
                    <option></option>
                    <?
                    $usersnotinorg = $userrepository->fetchByOrganizationNotInOrga();

                    foreach ($usersnotinorg as $usernotinorg) {
                        /** @var User $user */
                        $user = ((Object)$usernotinorg)->user;
                        ?>
                        <option
                                data-id="<? echo $user->getId();?>"
                                data-surname="<? echo $user->getSurname(); ?>"
                                data-name="<? echo $user->getName()?>"
                                ><? echo $user->getSurname() . ' ' . $user->getName()?>
                        </option>
                    <? } ?>
                </select>
            </div>
            <div class="col">
                <button onclick="DisplayAndloadFormUser()">Ajouter <br/>un utilisateur</button>
            </div>
        </div>
        <div class="row">
            <div class="col align-self-center" id="form-update-to-admin" style="display: none">
                <div class="formulaire">
                    <input id="id-user-admin" type="hidden" >
                    <div style="display: table-row">
                        <label class="label-lenght-fix" for="name-user-admin">Name :</label>
                        <input id="name-user-admin" readonly>
                    </div>
                    <div style="display: table-row">
                        <label class="label-lenght-fix" for="surname-user-admin">Prénom :</label>
                        <input id="surname-user-admin" readonly>
                    </div>
                    <div>
                        <button onclick="BecomeAdmin()">Devient Admin</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col align-self-center" id="form-add-admin" style="display: none">
                <?php
                include_once 'user.php';
                ?>
            </div>
        </div>
    </div>



<script>
    function BecomeAdmin() {
        var id = $("#id-user-admin").val();
        $.get({
            url:'becomeadmin.php',
            data:{
                id:id
            }
            //TODO Ajouter le refresh de la liste select-user-add
        })

    }

    function LoadFormualire() {
        var id = $("#select-user-add").find(':selected').attr('data-id');
        var surname = $("#select-user-add").find(':selected').attr('data-surname');
        var name = $("#select-user-add").find(':selected').attr('data-name');
        $("#id-user-admin").val(id);
        $("#surname-user-admin").val(surname);
        $("#name-user-admin").val(name);
        $('#form-update-to-admin').css('display','block');
    }


    function DisplayAndloadFormUser() {
        $('#form-add-admin').css('display','block');
    }


</script>