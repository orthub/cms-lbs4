<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <?php echo (isset($_SESSION['new-post'])) ? '<p class="success-msg">' . $_SESSION['new-post'] . '</p>' : '' ?>
        <?php unset($_SESSION['new-post']) ?>
        <?php require_once __DIR__ . '/../controllers/posts.php' ?>
        <?php require_once __DIR__ . '/../controllers/userRights.php' ?>
        <?php $posts = get_last_ten_posts() ?>
        <div class="content-posts">
          <?php foreach ($posts as $post) : ?>
          <?php if ($post['published'] === 'LIVE') : ?>
          <div class="post">
            <div class="content">
              <h2><?php echo $post['title'] ?></h2>
              <p><?php echo $post['body'] ?></p>
              <hr />
              <small><?php echo $post['first_name'] . ' | ' . $post['created'] ?></small>
              <form action="/views/post.php" method="GET">
                <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                <input class="button" type="submit" value="Weiter lesen...">
              </form>
            </div>
            <div class="clear-float"></div>
          </div>
          <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
  </div>
</body>

</html>