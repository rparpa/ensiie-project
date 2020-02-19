<?php
namespace Register;
use PDO;

class RegisterView {
    public function __construct() {
    }
    
    public function afficheFormulaire() {
        ?>
        <form action="index.php?action=register" method="POST">
           <div class="field">
                <div class="control has-icons-left has-icons-right">
                  <input class="input is-large" name="firstname" type="text" placeholder="Prénom">
                    <span class="icon is-small is-left">
                      <i class="fa fa-key" aria-hidden="true"></i>
                    </span>
                </div>
              </div>

              <div class="field">
                <div class="control has-icons-left has-icons-right">
                  <input class="input is-large" name="lastname" type="text" placeholder="Nom de famille">
                    <span class="icon is-small is-left">
                      <i class="fa fa-key" aria-hidden="true"></i>
                    </span>
                </div>
              </div>

              <div class="field">
                <div class="control has-icons-left has-icons-right">
                  <input class="input is-large" name="birthday" type="text" placeholder="Date d'anniversaire">
                    <span class="icon is-small is-left">
                      <i class="fa fa-key" aria-hidden="true"></i>
                    </span>
                </div>
              </div>

              <div class="field">
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-large" type="text" placeholder="Email" name="email" autofocus="">
                    <span class="icon is-small is-left">
                      <i class="fa fa-envelope"></i>
                    </span>
                </div>
              </div>
              <div class="field">
                <div class="control has-icons-left has-icons-right">
                  <input class="input is-large" name="password" type="password" placeholder="Mot de passe">
                    <span class="icon is-small is-left">
                      <i class="fa fa-key" aria-hidden="true"></i>
                    </span>
                </div>
              </div>
              
              <input class="button is-block is-info is-large" type="submit" value="Connexion" style="width: 100%;">
            </form>
        <?php
    }
}
?>