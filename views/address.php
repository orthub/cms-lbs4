<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/../controllers/getDeliveryAddress.php';
require_once __DIR__ . '/../controllers/address.php';
require_once __DIR__ . '/../controllers/orders.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/partials/userbar.php' ?>
    <div class="space-mid"></div>
    <div class="row">
      <div class="col-2">

        <p class="text-bold">Vorhandene Adressen:</p>
      </div>
      <div class="col-8">
      </div>
      <div class="col-2"></div>
    </div>
    <div class="row">
      <?php foreach ($deliveryAddress as $key => $value) : ?>
      <div class="col-2">
        <div class="delivery-address">
          <form action="/controllers/address.php" method="POST">
            <?php echo $value['city'] . '<br />';
            echo $value['zip_code'] . '<br />';
            echo $value['street'] . ' / ' . $value['street_number'] . '<br />';
            ?>
            <input type="hidden" value="<?php echo $value['id'] ?>" name="deliveryId" />
            <input class="button" type='submit' value='Auswählen und weiter' />
          </form>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    <div class="space-mid"></div>
    <div class="clear-float"></div>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">

        <h2>Neue Lieferadresse:</h2>
        <form action="/controllers/newDeliveryAddress.php" method="POST">
          <label for='street'>Straße:</label><br />
          <input type='text' name='street'
            id='street' /><?php echo (!empty($_SESSION['errors']['street'])) ? $_SESSION['errors']['street'] : '' ?><br /><br />
          <label for='streetNumber'>Straßennummer:</label><br />
          <input type='text' name='streetNumber'
            id='streetNumber' /><?php echo (!empty($_SESSION['errors']['streetNumber'])) ? $_SESSION['errors']['streetNumber'] : '' ?><br /><br />
          <label for='city'>Stadt:</label><br />
          <input type='text' name='city'
            id='city' /><?php echo (!empty($_SESSION['errors']['city'])) ? $_SESSION['errors']['city'] : '' ?><br /><br />
          <label for='zip'>Postleitzahl:</label><br />
          <input type='text' name='zip'
            id='text' /><?php echo (!empty($_SESSION['errors']['zip'])) ? $_SESSION['errors']['zip'] : '' ?><br /><br />
          <input class="button" type='submit' value='Lieferadresse hinzufügen' />
        </form>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
  <div class="space-big"></div>

  <?php require_once __DIR__ .'/partials/footer.php' ?>
</body>

</html>