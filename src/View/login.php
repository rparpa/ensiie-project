<form action="authenticate.php" method="post">
  <div>
    <label>Email :</label>
      <label>
          <input type="text" name="email" />
      </label>
  </div>
  <div>
    <label>password :</label>
      <label>
          <input type="password" name="password" />
      </label>
  </div>
  <?php if (isset($data['failedAuthent'])): ?>
      <span class="error-message"><?= $data['failedAuthent'] ?></span>
    <?php endif; ?>
  <button type="submit">Valider</button>
</form>