<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
unset($_SESSION['totalPrice']);
unset($_SESSION['deliveryId']);
unset($_SESSION['deliveryAddressId']);
unset($_SESSION['before_post']);
unset($_SESSION['in_post']);
unset($_SESSION['order_saved']);
unset($_SESSION['cart_products_saved']);
unset($_SESSION['cart_products_deleted']);
unset($_SESSION['base-order']);
unset($_SESSION['products-from-order']);
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/partials/userbar.php' ?>
    <div class="space-big"></div>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 text-center">
        <h3>Danke für Ihre Bestellung.</h3>
        <div class="space-mid"></div>
        <a href="/views/products.php">Weiter Einkaufen?</a>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>