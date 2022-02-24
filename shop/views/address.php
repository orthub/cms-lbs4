<?php
require_once __DIR__ . '/../controllers/getDeliveryAddress.php';
require_once __DIR__ . '/../controllers/address.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <div class="userAddress">
      <p>Vorhandene Adresse:</p>
      <?php foreach ($deliveryAddress as $key => $value) : ?>
      <div class="delivery-address">
        <form action="/shop/controllers/address.php" method="POST">
          <!-- /view/checkout.php -->
          <?php echo $value['city'] . '<br />';
            echo $value['zip_code'] . '<br />';
            echo $value['street'] . ' / ' . $value['street_number'] . '<br />';
            ?>
          <input type="hidden" value="<?php echo $value['id'] ?>" name="deliveryId" />
          <input type='submit' value='Auswählen und weiter' />
        </form>
      </div>
      <?php endforeach ?>
    </div>
    <div class="clear-left"></div>
    <h2>Neue Lieferadresse:</h2>
    <form action="/shop/controllers/newDeliveryAddress.php" method="POST">
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
      <input type='submit' value='Lieferadresse hinzufügen' />
    </form>
  </div>

</body>

</html>