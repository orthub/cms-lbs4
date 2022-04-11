<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}
require_once __DIR__ . '/../controllers/invoice.php';
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
        <h2>Rechnung:</h2>
      </div>
      <div class="col-6"></div>
      <div class="col-4"></div>
    </div>
    <hr />
    <div class="row">
      <div class="col-4">
        <p>Bestell Nummer: <b><?php echo $_SESSION['base-order']['orders_id'] ?></b></p>
        <p>Bestell Datum: <b><?php echo date('d.m.Y', strtotime($_SESSION['base-order']['order_date'])) ?></b></p>
        <p>Bestell Status:
          <b><?php echo ($_SESSION['base-order']['status'] === 'new') ? 'Zahlung noch nicht eingelangt' : 'Bezahlt' ?></b>
        </p>
      </div>
      <div class="col-5"></div>
      <div class="col-3"></div>
    </div>
    <hr />
    <div class="row">
      <div class="col-4">
        <h2>Produkte:</h2>
        <table>
          <thead>
            <tr>
              <th>Produkt:</th>
              <th>Stück:</th>
              <th>Preis:</th>
            </tr>
          </thead>
          <?php $endprice = 0; ?>
          <?php foreach ($_SESSION['products-from-order'] as $value) : ?>
          <tr>
            <td><?php echo $value['title'] ?></td>
            <td><?php echo $value['quantity'] ?></td>
            <td><?php echo $value['price'] / 100 ?></td>
            <?php
            $price = $value['price'] * $value['quantity'];
            $endprice = $endprice + $price;
            ?>
          </tr>
          <?php endforeach ?>
        </table>
      </div>
      <div class="col-5">

      </div>
      <div class="col-3"></div>
    </div>
    <div class="row">
      <div class="col-6">
        <h2>Gesamtpreis (inkl. MwSt) und Versand: <?php echo $endprice / 100 . '€' ?></h2>
        <p></p>
        <form action="/controllers/createInvoice.php" method="POST">
          <input type="hidden" name="order_id" value="<?php echo $_SESSION['base-order']['orders_id'] ?>">
          <input type="hidden" name="endprice" value="<?php echo $endprice ?>">
          <input class="button" type="submit" name="invoice" value="Rechnung herunterladen">
        </form>
      </div>
      <div class="col-4"></div>
      <div class="col-2"></div>
    </div>

  </div>
</body>

</html>