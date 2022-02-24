<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <div class="container">
    <h1>Login</h1>
    <?php echo (isset($_SESSION['error-login'])) ? $_SESSION['error-login'] : '';
    unset($_SESSION['error-login']); ?>
    <div class="login-form">
      <form action="/cms/controllers/login.php" method="POST">
        <label for="email-login">Email:</label><br />
        <input type="email" name="email" id="email-login" /><br /><br />
        <label for="pass-login">Passwort:</label><br />
        <input type="password" name="passwd" id="pass-login" /><br /><br />
        <input type="submit" value="Login" />
      </form>
    </div>
    <br />
    <a href="/cms/views/register.php">Keinen Account? Hier gehts zur Registrierung</a>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
  </div>
</body>

</html>