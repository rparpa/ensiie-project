<?php
namespace Admin;
use PDO;

class AdminView {
    public function __construct() {
    }

    public function afficheAjoutVoiture() {
        ?>
        <form action="index.php?action=connect" method="POST">
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