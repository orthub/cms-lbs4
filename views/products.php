<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/../models/products.php';
$products = get_all_live_products();

?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php unset($_SESSION['errors']['email']) ?>
  <?php unset($_SESSION['errors']['password']) ?>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <?php echo (isset($_SESSION['new-product']) ? '<p class="text-center success-msg">' . $_SESSION['new-product'] . '</p>' : '' ) ?>
  <?php unset($_SESSION['new-product']) ?>

  <div class="row">
    <?php foreach($products as $product) : ?>
    <div class="col-3">
      <p class="text-bold"><?php echo $product['title'] ?></p>
      <img class="product-img" src="<?php echo $product['img_url'] ?>" alt="<?php echo $product['slug'] ?>">
      <p><?php echo $product['description'] ?></p>
      <p><?php echo $product['price'] / 100 . '€' ?></p>
      <p><?php echo $product['category'] ?></p>
      <?php echo ($product['quantity'] === 0) ? '' : '<p>Lagernd: ' . $product['quantity'] . '</p>' ?>
      <?php if ($product['quantity'] >= 1) : ?>
      <form action="/../controllers/addToCart.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
        <input class="button" type="submit" value="In den Warenkorb" />
      </form>
      <?php endif ?>
      <?php if ($product['quantity'] === 0) : ?>
      <p class="text-danger">Ausverkauft</p>
      <?php endif ?>
    </div>
    <?php endforeach ?>
  </div>

  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>