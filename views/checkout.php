<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../config/company_data.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>

  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <?php require_once __DIR__ . '/../lib/error_messages.php' ?>
  <div class="row">
    <div class="col-4">
      <p><b>Lieferung zur folgenden Adresse:</b></p>
      <br />
      <?php echo $_SESSION['checkout']['deliveryName']['first_name'] . ' ' . $_SESSION['checkout']['deliveryName']['last_name'] ?><br />
      <?php echo $_SESSION['checkout']['deliveryAddress']['city'] ?><br />
      <?php echo $_SESSION['checkout']['deliveryAddress']['zip_code'] ?><br />
      <?php echo $_SESSION['checkout']['deliveryAddress']['street'] . ' / ' . $_SESSION['checkout']['deliveryAddress']['street_number'] ?>
    </div>
    <div class="col-6">
      <p><b>Die Zahlungsinformationen erhalten sie wenn sie auf Kostenpflichtig bestellen klicken.</b></p>
      <p>Bitte beachten sie, wir die Versenden die Waren erst wenn sie diese Bezahlt haben und die Zahlung auf unserem
        Konto eingelangt ist.</p>
      <div class="space-small"></div>
      <form action="/controllers/thankyou.php" method="POST">
        <input type="hidden" name="deliveryId" value="<?php echo $_SESSION['checkout']['deliveryAddress']['id'] ?>">
        <input class="button" type="submit" value="Kostenpflichtig bestellen">
      </form>
      <p class="checkout-text"><b>Die Lieferung erfolgt erst nach Zahlungseingang auf unser Konto:</b></p><br />
      <p class="checkout-text">Bank: <b><?php echo ACCOUNT_NAME ?></b></p>
      <p class="checkout-text">BLZ: <b><?php echo ACCOUNT_BLZ ?></b></p>
      <p class="checkout-text">Kontonummer: <b><?php echo ACCOUNT_NUMBER ?></b></p>
      <p class="checkout-text">Verwendungszweck: <b><?php echo $_SESSION['order_id'] ?></b></p>
      <p class="checkout-text">Betrag:
        <?php echo '<b>' . $_SESSION['totalPrice'] . '€</b> inkl 2,55€ Versandkosten' ?></p>
    </div>
    <div class="col-2"></div>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>