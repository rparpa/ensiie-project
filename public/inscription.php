<!doctype html>

<html lang="fr">
<?php include("header.html"); ?>

<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark ">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
    
    <a class="navbar-brand" href="#">
      <a href="/index.html" id="title_Wikipediie">Wikiped<span style="color: #4998a7">IIE</span></a>
    </a>  
      <form>
          <div class="form-inline">
             <div class="form-group mx-sm-2 mb-2">
                <input style="height:20px; width:150px" type="text" class="form-control input-sm" id="inputsm" placeholder="Username ">
             </div>
          <div class="form-group mb-2">
            <input style="height:20px; width:150px" type="text" class="form-control input-sm" id="inputsm" placeholder="Password">
          </div>
         <div class="form-group mx-sm-2 ">
            <button onclick="verify_user();" type="button" class="btn btn-secondary btn-sm mb-2">Connexion</button>
           </div>
          <div class="form-group mx-sm-1 ">
             <button onclick="add_new_article()" type="button" class="btn btn-secondary btn-sm mb-2 onlyUser">Ajouter un article</button>
             <button onclick="deconnection()" type="button" class="btn btn-secondary btn-sm mb-2 onlyUser ">Deconnexion</button> 
          </div>
          <div class="form-group ">
             <button onclick="deconnection()" type="button" class="btn btn-secondary btn-sm mb-2 notUser">Inscription</button>  
          </div>
          </div>
        </form>
    </div>
  </nav>
  <nav>
  <div class=" sidenav row vh-100 overflow-auto collapse " id="navbarToggleExternalContent">
    <div class="col-12 col-sm-3 col-xl-2  px-0  bg-dark d-flex ">
        <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
            <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                    <a href="#" class=" px-sm-0 px-2">
                        <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline "></span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" data-bs-toggle="collapse" class="nav-link px-sm-0 px-2">
                        <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">About</span> </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-sm-0 px-2">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Registration</span></a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link px-sm-0 px-2">
                        <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Pages Validation</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-sm-0 px-2">
                        <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                </li>
            </ul>
        </div>
    </div>   
  </div>
</nav>



    <div class="card text-center mx-auto bg-light mb-3" style="width: 1000px; margin-top:150px"> 
      <div class="card-header bg-info text-white">
            Create Account
      </div>
      <div class="card-body"></div>
    <form>
     <div class="d-flex h-100">
      <div class="m-auto">
      <div class="form-group">
      <label for="validationServerUsername" class="form-label">Username :</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Enter a username" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
      <div id="validationServerUsernameFeedback" class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
      </div>
      <div class="form-group">
      <label for="validationServerUsername" class="form-label">Email :</label>

    <div class="input-group has-validation">
      <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Enter your email" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
      <div id="validationServerUsernameFeedback" class="invalid-feedback">
        Please enter a valid email.
      </div>
    </div>
  </div>
    <div class="form-group">
       <label for="validationServerUsername" class="form-label">Password :</label>
         <div class="input-group has-validation">
           <input type="password" class="form-control is-invalid" id="validationServerUsername" placeholder="Enter a password" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                  Please choose a valid password.
                </div>
              </div></div>
            <div class="form-group">
              <label for="validationServerUsername" class="form-label">Password validation :</label>
              <div class="input-group has-validation">
                <input type="password" class="form-control is-invalid" id="validationServerUsername" placeholder="Validate the password"  aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                  Please validate the password.
                </div>
              </div></div>

            <div class="form-group">
              <button type="submit" class="btn btn-info text-white" onclick="send_inscription()">Register</button>
            </div>
          </div>
           </form>
      </div> </div></div>

</body>

</html>
