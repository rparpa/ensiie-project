<!--<link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>-->
<script>
    $(document).ready(function () {
        $imgSrc = $('#imgProfile').attr('src');
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgProfile').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#btnChangePicture').on('click', function () {
            // document.getElementById('profilePicture').click();
            alert("Not implemented Yet !");
           // if (!$('#btnChangePicture').hasClass('changing')) {
            //    $('#profilePicture').click();
           // }
           // else {
                // change
           // }
        });
        $('#profilePicture').on('change', function () {
            readURL(this);
            $('#btnChangePicture').addClass('changing');
            $('#btnChangePicture').attr('value', 'Confirm');
            $('#btnDiscard').removeClass('d-none');
            // $('#imgProfile').attr('src', '');
        });
        $('#btnDiscard').on('click', function () {
            // if ($('#btnDiscard').hasClass('d-none')) {
            $('#btnChangePicture').removeClass('changing');
            $('#btnChangePicture').attr('value', 'Change');
            $('#btnDiscard').addClass('d-none');
            $('#imgProfile').attr('src', $imgSrc);
            $('#profilePicture').val('');
            // }
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                <div class="middle">
                                    <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                    <input type="file" style="display: none;" id="profilePicture" name="file" />
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">
                                        <?= $this->session->userdata('logged_in')['nom']." ".$this->session->userdata('logged_in')['prenom'] ?>
                                    </a><?php if($admin_user){
                        echo "<h6>Administrateur</h6>";
                                    } else echo "<h6>Utilisateur</h6>";?>
                                </h2>
                                <h6 class="d-block">Nombre d'annonces : <a href="javascript:void(0)"><?= $nbAnnonces ?></a></h6>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                        </div>
                    </div>
                <?php if(isset($this->session->userdata['logged_in']))?>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informations générales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Mes annonces</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Nom</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $this->session->userdata('logged_in')['nom'] ?>
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">prénom</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $this->session->userdata('logged_in')['prenom'] ?>
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">pseudo</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $pseudo ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">téléphone</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $telephone ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $this->session->userdata('logged_in')['email'] ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Promo</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <?= $promo ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 col-6" style="margin-left: 15%">
                                    <?php
                                    echo "<center>".form_button('modifier', 'Modifier mes informations personnelles',['class'=>"btn btn-warning btn-blo ck",'onClick'=>"redirect(".$id_user.")"])."</center>";
                                    ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    <ul class="list-group">
                                        <?php
                                            foreach($annonces as $annonce)
                                            {
                                                echo "<li class=\"list-group-item\"> ** [".$annonce['id_annonce']."] ".$annonce['titre']."<br>Prix : ".$annonce["prix"]."€"."</li>";
										    }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function redirect(id) {
        window.location.href = "/utilisateur/update?id="+id;
    }
</script>