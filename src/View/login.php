<form action="authenticate.php" method="post">
  <div>
    <label>Email :</label>
    <input type="text" name="email" />
  </div>
  <div>
    <label>password :</label>
    <input type="password" name="password" />
  </div>
  <?php if (isset($data['failedAuthent'])): ?>
      <span class="error-message"><?= $data['failedAuthent'] ?></span>
    <?php endif; ?>
  <button type="submit">Valider</button>
</form>