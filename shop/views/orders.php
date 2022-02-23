<?php
require_once __DIR__ . '/../controllers/orders.php';
?>

<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <h2>Bestellübersicht</h2>
    <?php foreach ($orders as $order) : ?>
    <div class="user-orders">
      <?php echo 'Bestell Nr.: ' . $order['orders_id'] . '<br />' ?>
      <?php echo 'Bestell Datum: ' . $order['order_date'] . '<br />' ?>
      <?php echo 'Bestell Status: ' . $order['status'] . '<br />' ?>
      <?php echo 'Prod_id: ' . $order['product_id'] . '<br />' ?>
    </div>
    <?php endforeach ?>

  </div>
</body>

</html>