<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/part/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/part/navbar.php' ?>
    <form action="/controller/validateRegister.php" method="POST">
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
      <input type='submit' value='Registrieren' />
    </form>
  </div>

</body>

</html>