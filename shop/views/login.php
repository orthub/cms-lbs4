<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <p>Zum Einkaufen bitte Einloggen</p>
    <form action='/shop/controllers/validateLogin.php' method='POST'>
      <label for='email'>Email:</label><br />
      <input type='text' name='email'
        id='email' /><?php echo (!empty($_SESSION['errors']['email'])) ? $_SESSION['errors']['email'] : '' ?><br /><br />
      <label for='passwd'>Passwort:</label><br />
      <input type='password' name='password'
        id='passwd' /><?php echo (!empty($_SESSION['errors']['password'])) ? $_SESSION['errors']['password'] : '' ?><br /><br />
      <input type='submit' value='Einloggen' />
    </form>
  </div>
</body>

</html>