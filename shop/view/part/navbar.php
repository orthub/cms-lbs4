<?php require_once __DIR__ . '/../../model/cart.php';
$cartItemsCount = null;
if (isset($_SESSION['userId'])) {
  $cartItemsCount = count_products_for_user($_SESSION['userId']);
}
?>
<div class="navbar">
  <a href="/">S H O P</a> |
  <?php if (isset($_SESSION['userId'])) : ?>
  <?php echo '<a href="/view/logout.php">Ausloggen</a> |' ?>
  <?php endif ?>
  <?php if (!isset($_SESSION['userId'])) : ?>
  <?php echo '<a href="/view/login.php">Einloggen</a> |' ?>
  <?php echo '<a href="/view/register.php">Registrieren</a> |' ?>
  <?php endif ?>
  <a href="/view/cart.php">Warenkorb (<?php echo ($cartItemsCount === null) ? '0' : $cartItemsCount ?>)</a>
  <?php
  require_once __DIR__ . '/../../model/login.php';
  if (isset($_SESSION['userId'])) {
    echo '<a class="navbar-user" href="/view/orders.php"> | Bestellungen</a>';
    $userName = get_user_name($_SESSION['userId']);
    echo '<p class="navbar-user">Hallo ' . $userName . '&nbsp</p>';
  } ?>
</div>