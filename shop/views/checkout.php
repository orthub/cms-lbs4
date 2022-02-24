<?php
require_once __DIR__ . '/../controllers/checkout.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php echo (isset($_SESSION['order_saved'])) ? $_SESSION['order_saved'] : '' ?>
    <?php echo (isset($_SESSION['cart_products_saved'])) ? $_SESSION['cart_products_saved'] : '' ?>
    <?php echo (isset($_SESSION['cart_products_deleted'])) ? $_SESSION['cart_products_deleted'] : '' ?>
    <p>Lieferung zur folgenden Adresse:</p>
    <?php echo $deliveryName['first_name'] . ' ' . $deliveryName['last_name']
    ?><br />
    <?php echo $deliveryAddress['city'] ?><br />
    <?php echo $deliveryAddress['zip_code'] ?><br />
    <?php echo $deliveryAddress['street'] . ' / ' . $deliveryAddress['street_number'] ?>
    <hr />
    <p>Rechnungsbetrag:</p>
    <?php echo $_SESSION['totalPrice'] . '€' ?>
    <div class="space-md"></div>
    <p>Die Bestellung wird abgeschickt, sobald der Betrag auf unser Konto eingelangt ist.</p>
    <form action="/shop/controllers/checkout.php" method="POST">
      <input type="hidden" name="deliveryId" value="<?php echo $deliveryAddress['id'] ?>">
      <input type="submit" value="Kostenpflichtig bestellen">
    </form>
  </div>

</body>

</html>