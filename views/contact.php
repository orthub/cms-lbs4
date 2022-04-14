<?php require_once __DIR__ . '/../helpers/session.php'; ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <div class="content">
    <div class="space-mid"></div>
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <?php require_once __DIR__ . '/../helpers/flashMessage.php' ?>
        <h1>Kontaktformular</h1>
        <p>Wenn Sie irgendwelche Anliegen haben, zögern Sie nicht und Kontaktieren Sie uns.</p>
        <div class="space-small"></div>
        <form action="/controllers/contact.php" method="POST">
          <label for="email">Email:</label><br />
          <input id="email" type="email" name="contact-email"
            value="<?php echo (isset($_SESSION['contact']['email'])) ? $_SESSION['contact']['email'] : '' ?>" /><br /><br />
          <label for="title">Titel:</label><br />
          <input id="title" type="text" name="contact-title"
            value="<?php echo (isset($_SESSION['contact']['title'])) ? $_SESSION['contact']['title'] : '' ?>" /><br /><br />
          <label for="message">Nachricht:</label><br />
          <textarea id="message"
            name="contact-message"><?php echo (isset($_SESSION['contact']['message'])) ? $_SESSION['contact']['message'] : '' ?></textarea><br /><br />
          <input class="button" type="submit" value="Abschicken" />
        </form>
      </div>
      <div class="col-3"></div>
    </div>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>