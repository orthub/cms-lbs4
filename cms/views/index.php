<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/../models/posts.php' ?>
    <?php $posts = get_last_five_posts()  ?>
    <div class="content-posts">
      <?php foreach ($posts as $post) : ?>
      <div class="post">
        <div class="post-image">
          <img src="<?php echo $post['image'] ?>" alt="image for post number <?php echo $post['id'] ?>">
        </div>
        <div class="content">
          <h2><?php echo $post['title'] ?></h2>
          <p><?php echo $post['body'] ?></p>
          <small><?php echo $post['first_name'] . ' | ' . $post['created'] ?></small>
          <form action="/cms/views/post.php" method="GET">
            <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
            <input type="submit" value="Read more...">
          </form>
        </div>
        <div class="clear-float"></div>
        <hr />
      </div>
      <?php endforeach ?>
    </div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>