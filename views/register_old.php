<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <?php require_once __DIR__ . '/partials/navbar.php' ?>
        <form action="/controllers/validateRegister.php" method="POST">
          <label for='firstName'>Vorname:</label><br />
          <input type='text' name='first_name'
            id='firstName' /><?php echo (!empty($_SESSION['errors']['firstName'])) ? $_SESSION['errors']['firstName'] : '' ?><br /><br />
          <label for='lastName'>Nachname:</label><br />
          <input type='text' name='last_name'
            id='lastName' /><?php echo (!empty($_SESSION['errors']['lastName'])) ? $_SESSION['errors']['lastName'] : '' ?><br /><br />
          <label for='email'>Email:</label><br />
          <input type='text' name='email'
            id='email' /><?php echo (!empty($_SESSION['errors']['email'])) ? $_SESSION['errors']['email'] : '' ?><br /><br />
          <!-- <label for='confirmEmail'>Email wiederholen:</label><br />
  <input type='text' name='confirm-email' id='confirmEmail' /><br /><br /> -->
          <label for='passwd'>Passwort:</label><br />
          <input type='password' name='password'
            id='passwd' /><?php echo (!empty($_SESSION['errors']['password'])) ? $_SESSION['errors']['password'] : '' ?><br /><br />
          <!-- <label for='confirmPasswd'>Passwort wiederholen:</label><br />
  <input type='password' name='confirm_password' id='confirmPasswd' /><br /><br /> -->
          <input class="button" type='submit' value='Registrieren' />
        </form>
      </div>
    </div>
    <div class="col-4"></div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>