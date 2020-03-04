<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">times;</span>
  <form class="modal-content" action="loginController.php" method="post" >
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="login"><b>Login</b></label>
      <input type="text" placeholder="Enter login" name="login" id="login" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>

      <input id="action" name="action" type="hidden" value="inscriptionAction">

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>

    </div>
  </form>
</div>



<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">times;</span>
  <form class="modal-content" action="loginController.php" method="post" >
    <div class="container">
      <h1>Login</h1>
      <hr>
      <label for="login"><b>Login</b></label>
      <input type="text" placeholder="Enter login" name="login" id="login" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>

      <input id="action" name="action" type="hidden" value="loginAction">

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Login</button>
      </div>

    </div>
  </form>
</div>



<footer style="position:fixe; bottom: 0;">
  <p style="text-align:center;">Company © Poke-iiens. All rights reserved.</p>
</footer>

</body>
</html>

<script>
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }else if(event.target == modal2){
      modal2.style.display = "none";
    }
}
</script>
