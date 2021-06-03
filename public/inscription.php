<!doctype html>

<html lang="fr">
<?php include("header.html"); ?>

<body class="bg-light">

<?php include("navbar.html"); ?>
 

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
