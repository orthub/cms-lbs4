<?php
session_start();
require_once __DIR__ . '/model/products.php';
$products = get_products();

?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/view/part/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/view/part/navbar.php' ?>
    <?php if (isset($_SESSION['errors'])) {
      echo '<div class="errorMessages">';
      foreach ($_SESSION['errors'] as $key => $value) {
        echo $value . '<br />';
      }
      echo '</div>';
    }
    ?>
    <div class="products">
      <table>
        <thead>
          <th>Titel</th>
          <th>Beschreibung</th>
          <th>Preis</th>
          <th></th>
        </thead>
        <tbody>
          <?php foreach ($products as $product) : ?>
          <tr>
            <td><?php echo $product['title'] ?></td>
            <td><?php echo $product['description'] ?></td>
            <td><?php echo $product['price'] / 100 . '€' ?></td>
            <td>
              <form action="/controller/addToCart.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
                <input type="submit" value="Hinzufügen" />
              </form>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>