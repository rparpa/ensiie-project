<?php
namespace User;
use PDO;

class UserView {
  public function __construct() {
  }

  public function afficheFormulaireConnexion() {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Connexion</h3>

        <form id="form_connexion" class="fadeIn first" action="index.php?action=connect" method="POST">
          <input type="text" id="email" name="email" placeholder="Adresse email">
          <input type="password" id="password" name="password" placeholder="Mot de passe">
          <input type="submit" name="connection" value="Connexion">
        </form>

        <div id="formFooter">
          <a class="underlineHover" href="index.php?action=reset">Mot de passe oublié ?</a>
        </div>
      </div>
    </div>
    <?php
  }

  public function afficheFormulaireInscription() {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Formulaire d'inscription</h3>
        <form id="form_inscription" class="fadeIn first" action="index.php?action=register" method="POST">
          <input type="text" id="name" name="name" placeholder="Nom">
          <input type="text" id="firstname" name="firstname" placeholder="Prénom">
          <input type="email" id="email" name="email" placeholder="Adresse email">
          <input type="date" id="birthday" name="birthday" placeholder="Date de naissance">
          <input type="password" id="password" name="password" placeholder="Mot de passe">
          <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmer le mot de passe">
          <input type="submit" name="register" value="S'inscrire">
        </form>

        <div id="formFooter">
          <a class="underlineHover" href="index.php?action=connect">Vous avez déjà un compte ?</a>
        </div>
      </div>
    </div>
    <?php
  }

  public function showUsers($users) {
    ?>
    <table class="table table-bordered table-hover table-striped">
      <thead style="font-weight: bold">
        <td>#</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Age</td>
      </thead>
      <?php /** @var User $user */
      foreach ($users as $user) : ?>
        <tr>
          <td><?php echo $user->getId() ?></td>
          <td><?php echo $user->getFirstname() ?></td>
          <td><?php echo $user->getLastname() ?></td>
          <td><?php echo $user->getAge() ?> years</td>
        </tr>
      <?php endforeach; ?>
    </table>
    <?php
  }

  public function afficheFormulaireReset() {
    ?>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <h3 class="fadeIn first title">Réinitialisation d'identifiants</h3>

        <form id="form_reset" class="fadeIn first" action="index.php?action=reset" method="POST">
          <input type="email" id="email" name="email" placeholder="Adresse email">
          <input type="submit" name="reset" value="Envoyer">
        </form>

      </div>
    </div>
    <?php
  }

  public function vueErreur($erreur) {
    ?>
    <h3><?php echo $erreur ?></h3>
    <?php
  }

  public function vueConfirm($msg) {
    echo '<script type="text/javascript">alert("'.$msg.'");</script>';
  }
}
?>