<?php
session_start();
require_once __DIR__ . '/../controller/cart.php';
?>

<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/part/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/part/navbar.php' ?>
    <h2>Einkaufstüte :)</h2>
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
            <form action="/controller/removeFromCart.php" method="POST">
              <input type="hidden" name="productId" value="<?php echo $cartItem['product_id'] ?>">
              <input type="submit" value="Entfernen">
            </form>
          </td>
        </tr>
        <?php endforeach ?>
        <?php $_SESSION['totalPrice'] = $totalPrice ?>
      </tbody>
    </table>
    <div class="space-md"></div>
    <table>
      <tbody>
        <tr>
          <p>Gesamtkosten: <?php echo $totalPrice ?>€</p>
        </tr>
      </tbody>
    </table>
    <div class="space-sm"></div>
    <a href="/view/address.php">Lieferadresse auswählen/hinzufügen</a>
  </div>
</body>

</html>