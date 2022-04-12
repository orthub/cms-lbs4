<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/../controllers/orders.php';
?>

<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/partials/userbar.php' ?>
    <div class="row">
      <div class="col-2">
        <h2>Bestellübersicht:</h2>
      </div>
      <div class="col-6"></div>
      <div class="col-4"></div>
    </div>
    <hr />
    <?php foreach($orders as $order) : ?>
    <div class="row">
      <div class="col-">
        <p>Bestell Nummer: <b><?php echo $order['orders_id'] ?></b></p>
        <p>Bestell Datum: <b><?php echo date('d.m.Y', strtotime($order['order_date'])) ?></b></p>
        <p>Bestell Status: <b><?php echo ($order['status'] === 'new') ? 'Zahlung noch nicht eingegangen' : ''?></b></p>
        <form action="/controllers/invoice.php" method="POST">
          <input type="hidden" name="order_id" value="<?php echo $order['orders_id'] ?>">
          <input class="button" type="submit" name="invoice" value="Rechnung ansehen">
        </form>
      </div>
    </div>
    <hr />
    <?php endforeach ?>
  </div>
</body>

</html>