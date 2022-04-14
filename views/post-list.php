<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../controllers/dashboard.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>

  <div class="space-big"></div>
  <div class="content">

    <table>
      <thead>
        <tr>
          <th>Titel</th>
          <th>Post</th>
          <th>Autor</th>
          <th>Erstellt</th>
          <th>Veröffentlicht</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all_posts as $post) : ?>
        <tr>
          <td><?php echo $post['title'] ?></td>
          <td><?php echo $post['body'] ?></td>
          <td><?php echo $post['first_name'] ?></td>
          <td><?php echo $post['created'] ?></td>
          <td><?php echo ($post['published'] === 'LIVE') ? 'Ja ' : 'Nein ' ?>
            <?php echo ($post['published'] === 'LIVE') ?'<i class="fa-solid fa-circle green"></i>' :'<i class="fa-solid fa-circle red"></i>' ?>
          </td>
          <td>
            <form action="/controllers/editPost.php" method="POST">
              <input type="hidden" name="edit-post" value="<?php echo $post['id'] ?>">
              <input class="button" type="submit" value="Bearbeiten">
            </form>
          </td>
          <td>
            <?php if ($role === 'ADMIN') : ?>
            <form action="/controllers/deletePost.php" method="POST">
              <input type="hidden" name="delete-post" value="<?php echo $post['id'] ?>">
              <input class="button" type="submit" value="Löschen">
            </form>
            <?php endif ?>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>