<?php session_start() ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-8">
        <?php require_once __DIR__ . '/../controllers/posts.php' ?>
        <?php $posts = get_last_five_posts() ?>
        <div class="content-posts">
          <?php foreach ($posts as $post) : ?>
          <div class="post">
            <div class="post-image">
              <img src="<?php echo $post['image'] ?>" alt="image for post number <?php echo $post['id'] ?>">
            </div>
            <div class="content">
              <h2><?php echo $post['title'] ?></h2>
              <p><?php echo $post['body'] ?></p>
              <hr />
              <small><?php echo $post['first_name'] . ' | ' . $post['created'] ?></small>
              <form action="/cms/views/post.php" method="GET">
                <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                <input type="submit" value="Read more...">
              </form>
            </div>
            <div class="clear-float"></div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <div class="col-4">
        <h1>SOFTEC</h1>
        <p>The Company</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam nesciunt commodi eaque tenetur delectus atque
          cupiditate fugiat.</p>
      </div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php' ?>
  </div>
</body>

</html>