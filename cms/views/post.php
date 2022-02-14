<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>
<?php $post_id = htmlspecialchars($_GET['post_id']) ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/../controllers/posts.php' ?>
    <?php $single_post = get_full_post_from_id($post_id) ?>
    <div class="content-posts">
      <div class="single-post">
        <div class="post-image">
          <img src="<?php echo $single_post['image'] ?>" alt="image for post number <?php echo $single_post['id'] ?>">
        </div>
        <h2><?php echo $single_post['title'] ?></h2>
        <p><?php echo $single_post['body'] ?></p>
        <small><?php echo $single_post['first_name'] . ' | ' . $single_post['created'] ?></small>
        <a href="/"><button>Back</button></a>

      </div>

    </div>
  </div>
</body>

</html>