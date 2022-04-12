<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../controllers/cart.php';
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
      <div class="col-4"></div>
      <div class="col-4">
        <?php if (count($cartItems) > 0) : ?>
        <h2>Warenkorb</h2>
        <div class="space-small"></div>
        <table>
          <thead>
            <th>Produkt</th>
            <th>Stück</th>
            <th>Einzelpreis</th>
            <th>Preis</th>
            <th></th>
          </thead>
          <tbody>
            <?php foreach ($cartItems as $cartItem) : ?>
            <?php $totalPrice += $cartItem['price'] * $cartItem['quantity'] / 100 ?>
            <tr>
              <td><?php echo $cartItem['title'] ?></td>
              <td><?php echo $cartItem['quantity'] ?></td>
              <td><?php echo ($cartItem['price'] / 100) . '€' ?></td>
              <td><?php echo $cartItem['price'] / 100 * $cartItem['quantity'] . '€'  ?></td>
              <td>
                <form action="/controllers/removeFromCart.php" method="POST">
                  <input type="hidden" name="productId" value="<?php echo $cartItem['product_id'] ?>">
                  <input class="button" type="submit" value="Entfernen">
                </form>
              </td>
            </tr>
            <?php endforeach ?>
            <tr>
              <td>Versandkosten</td>
              <td></td>
              <td></td>
              <td>2,55€</td>
              <td></td>
            </tr>
            <?php $totalPrice = $totalPrice + 2.55 ?>
            <?php $_SESSION['totalPrice'] = $totalPrice ?>
          </tbody>
        </table>
        <div class="space-small"></div>
        <p class="text-right"><b>Gesamtkosten inkl. Versand: <?php echo $totalPrice ?>€</b></p>
      </div>
      <div class="col-4"></div>
    </div>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <a href="/views/address.php">Lieferadresse auswählen/hinzufügen</a>
      </div>
      <div class="col-4"></div>
    </div>
    <?php else : ?>
    <h2>Ihr Warenkorb ist leer</h2><br />
    <a href="/views/products.php">Hier geht es zu unseren Produkten</a>
    <?php endif ?>
    <div class="space-big"></div>
  </div>
  <?php require_once __DIR__ .'/partials/footer.php' ?>
</body>

</html>