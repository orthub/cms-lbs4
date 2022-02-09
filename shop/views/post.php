<?php require_once __DIR__ . '/../includes.php' ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/../views/partial/head.php' ?>
<?php $id = htmlspecialchars($_GET['post_id']) ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/../views/partial/navbar.php' ?>
    <?php $single_post = get_post_from_id($id) ?>
    <div class="content-posts">
      <div class="post">
        <h2><?php echo $single_post['title'] ?></h2>
        <p><?php echo $single_post['body'] ?></p>
        <small><?php echo $single_post['first_name'] . ' | ' . $single_post['created'] ?></small>
      </div>
    </div>
  </div>
</body>

</html>