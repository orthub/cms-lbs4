<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <div class="container">
    <h1>Login</h1>
    <form action="/cms//controllers/login.php" method="POST">
      <input type="email" name="email" />
      <input type="password" name="passwd" />
      <input type="submit" value="Login" />
    </form>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
  </div>
</body>

</html>