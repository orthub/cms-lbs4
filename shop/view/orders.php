<?php
require_once __DIR__ . '/../controller/orders.php';
?>

<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/part/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/part/navbar.php' ?>
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