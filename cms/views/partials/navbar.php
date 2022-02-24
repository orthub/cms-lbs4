<!-- <div class="navbar">
  <a href="/">Home | </a>
  <a href="/cms/views/login.php">Login | </a>
  <a href="/cms/views/logout.php">Logout | </a>
  <a href="/cms/views/register.php">Register | </a>
  <a href="/shop/index.php">Shop</a>
</div> -->
<?php
if (isset($_SESSION['userId'])) {
}
?>
<div class="navbar">
  <a href="/">ORTech</a>
  <?php if (isset($_SESSION['userId'])) :
  ?>
  <?php echo '<a href="/cms/views/logout.php">Ausloggen</a>'
    ?>
  <?php endif
  ?>
  <?php if (!isset($_SESSION['userId'])) :
  ?>
  <?php echo '<a href="/cms/views/login.php">Einloggen</a>'
    ?>
  <?php endif
  ?>
  <a href="/shop/index.php">Shop</a>
  <?php
  // require_once __DIR__ . '/../../models/login.php';
  require_once __DIR__ . '/../../../shop/models/login.php';
  if (isset($_SESSION['userId'])) {
    // echo '<a class="navbar-user" href="/shop/views/orders.php"> Bestellungen</a>';
    $userName = get_user_name($_SESSION['userId']);
    echo '<p class="navbar-user">Hallo ' . $userName . '&nbsp</p>';
  }
  ?>
</div>