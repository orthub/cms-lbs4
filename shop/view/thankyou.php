<?php
session_start();
unset($_SESSION['totalPrice']);
unset($_SESSION['deliveryId']);
unset($_SESSION['deliveryAddressId']);
unset($_SESSION['before_post']);
unset($_SESSION['in_post']);
unset($_SESSION['order_saved']);
unset($_SESSION['cart_products_saved']);
unset($_SESSION['cart_products_deleted']);
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/part/head.php' ?>
<?php var_dump($_SESSION) ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/part/navbar.php' ?>

    <h3>Danke für Ihre Bestellung.</h3>

  </div>

</body>

</html>