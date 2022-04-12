<?php require_once __DIR__ . '/../helpers/session.php'; ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/partials/userbar.php' ?>
    <?php if (isset($_SESSION['newPost']['body'])): ?>
    <?php $bodyPost = $_SESSION['newPost']['body'] ?>
    <?php endif ?>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <?php require_once __DIR__ . '/../lib/error_messages.php' ?>
        <form action="/controllers/newPost.php" method="POST">
          <label for="input-title">Titel</label><br />
          <input id="input-title" type="text" name="new-title"
            value="<?php echo (isset($_SESSION['newPost']['title'])) ? $_SESSION['newPost']['title'] : '' ?>" /><br />
          <label for="input-body">Post</label><br />
          <textarea id="input-body" name="new-body"><?php echo (isset($bodyPost))?$bodyPost:'' ?></textarea><br />
          <input class="button" type="submit" value="Speichern" />

          <button class="button-cancel pos-right"><a href="/views/posts.php">Abbrechen</a></button>
        </form>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>