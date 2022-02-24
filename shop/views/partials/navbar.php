<?php require_once __DIR__ . '/../../models/cart.php';
$cartItemsCount = null;
if (isset($_SESSION['userId'])) {
  $cartItemsCount = count_products_for_user($_SESSION['userId']);
} ?>
<div class="navbar">
  <a href="/">ORTech</a>
  <?php if (isset($_SESSION['userId'])) : ?>
  <?php echo '<a href="/shop/views/logout.php">Ausloggen</a>' ?>
  <?php endif ?>
  <?php if (!isset($_SESSION['userId'])) : ?>
  <?php echo '<a href="/shop/views/login.php">Einloggen</a>' ?>
  <?php endif ?>
  <a href="/shop/views/cart.php">Warenkorb (<?php echo ($cartItemsCount === null) ? '0' : $cartItemsCount ?>)</a>
  <?php
  require_once __DIR__ . '/../../models/login.php';
  if (isset($_SESSION['userId'])) {
    echo '<a class="navbar-user" href="/shop/views/orders.php"> Bestellungen</a>';
    $userName = get_user_name($_SESSION['userId']);
    echo '<p class="navbar-user">Hallo ' . $userName . '&nbsp</p>';
  } ?>
</div>