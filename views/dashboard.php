<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/../controllers/dashboard.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <?php if (isset($_SESSION['errors'])) {
      echo '<div class="errorMessages">';
      foreach ($_SESSION['errors'] as $key => $value) {
        echo $value . '<br />';
      }
      echo '</div>';
    }
    ?>
  <div class="space-big"></div>
  <table>
    <thead>
      <tr>
        <th>Vorname</th>
        <th>Email</th>
        <th>Rechte</th>
        <th>Neue Rechte</th>
        <th>Löschen</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($all_users as $user) : ?>
      <tr>
        <td><?php echo $user['first_name'] ?></td>
        <td><?php echo $user['email'] ?></td>
        <td><?php echo $user['role'] ?></td>
        <td>
          <?php if ($user['role'] != 'ADMIN') : ?>
          <form action="/controllers/new-role.php" method="POST">
            <select name="user-rights" id="userRights">
              <?php foreach ($roles as $role) : ?>
              <option value="<?php echo $role['role'] ?>"><?php echo $role['role'] ?></option>
              <?php endforeach ?>
              <input type="hidden" name="userId" value="<?php echo $user['id'] ?>">
              <input class="button" type="submit" value="Aktualisieren">
          </form>
          <?php endif ?>
        </td>
        <td>
          <form action="/controllers/delete-user.php" method="POST">
            <input type="hidden" name="removeUser" value="<?php echo $user['id'] ?>">
            <input class="button" type="submit" value="Löschen">
          </form>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <div class="space-mid"></div>
  <hr />
  <div class="space-mid"></div>
  <div class="all-product-link">
    <a href="/views/product-list.php">Alle Produkte anzeigen</a>
  </div>
  <table>
    <thead>
      <tr>
        <th></th>
        <th>Titel</th>
        <th>Kategorie</th>
        <th>Lagernd</th>
        <th>Preis</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($last_products as $product) : ?>
      <tr>
        <td><img class="dash-img" src="<?php echo $product['img_url'] ?>" alt="<?php echo $product['slug'] ?>">
        </td>
        <td><?php echo $product['title'] ?></td>
        <td><?php echo $product['category'] ?></td>
        <td class="text-right"><?php echo $product['quantity'] ?></td>
        <td><?php echo $product['price'] / 100 . '€' ?></td>
        <td>
          <form action="/controllers/editProduct.php" method="POST">
            <input type="hidden" name="edit-product" value="<?php echo $product['slug'] ?>">
            <input class="button" type="submit" value="Bearbeiten">
          </form>
        </td>
        <td>
          <form action="" method="POST">
            <input type="hidden" name="delete-product" value="<?php echo $product['id'] ?>">
            <input class="button" type="submit" value="Löschen">
          </form>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <div class="content">

  </div>
  <div class="space-small"></div>

  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>