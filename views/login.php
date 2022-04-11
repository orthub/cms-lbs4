<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <h1>Login</h1>
        <?php require_once __DIR__ . '/../lib/login_errors.php' ?>
        <div class="login-form">
          <form action="/controllers/login.php" method="POST">
            <label for="email-login">Email:</label><br />
            <input type="email" name="email" id="email-login"
              value="<?php echo (isset($_SESSION['loginEmail'])) ? $_SESSION['loginEmail'] : ''?>" /><br /><br />
            <label for="pass-login">Passwort:</label><br />
            <input type="password" name="passwd" id="pass-login"
              value="<?php echo (isset($_SESSION['loginPasswd'])) ? $_SESSION['loginPasswd'] : ''?>" /><br /><br />
            <input class="button" type="submit" value="Login" />
          </form>
        </div>
        <br />
        <a href="/views/register.php">Keinen Account? Hier gehts zur Registrierung</a>
      </div>
      <div class="col-4"></div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
  </div>
</body>

</html>