<?php require_once __DIR__ . '/../helpers/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>

  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">

        <?php require_once __DIR__ . '/../helpers/flashMessage.php' ?>
        <h1><a name="reg_anker">Registrieren</a></h1>
        <form action="/controllers/register.php" method="POST">
          <label for="first_name">Vorname</label>
          <input id="first_name" type="text" name="first_name"
            value="<?php echo (isset($_SESSION['registerFirstname'])) ? $_SESSION['registerFirstname'] : ''?>">
          <label for="last_name">Nachname</label>
          <input id="last_name" type="text" name="last_name"
            value="<?php echo (isset($_SESSION['registerLastname'])) ? $_SESSION['registerLastname'] : ''?>">
          <label for="email">Email</label>
          <input id="email" type="email" name="email"
            value="<?php echo (isset($_SESSION['registerEmail'])) ? $_SESSION['registerEmail'] : ''?>">
          <label for="passwd">Passwort</label>
          <input id="passwd" type="password" name="passwd"
            value="<?php echo (isset($_SESSION['registerPassword'])) ? $_SESSION['registerPassword'] : ''?>">
          <label for="confirm_passwd">Passwort wiederholen</label>
          <input id="confirm_passwd" type="password" name="confirm_passwd">
          <input class="button" type="submit" value="Registrieren">
        </form>
      </div>

      <div class="col-4"></div>
    </div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>