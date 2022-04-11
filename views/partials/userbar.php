<?php require_once __DIR__ . '/../../models/cart.php';
require_once __DIR__ . '/../../controllers/products.php';
require_once __DIR__ . '/../../controllers/userRights.php';
$cartItemsCount = null;
if (isset($_SESSION['userId'])) {
  $cartItemsCount = count_products_for_user($_SESSION['userId']);
} ?>


<div class="userbar">
  <?php
  require_once __DIR__ . '/../../models/login.php';
  if (isset($_SESSION['userId'])) : ?>
  <?php $userName = get_user_name($_SESSION['userId']); ?>
  <ul>
    <?php if ($role === 'ADMIN') : ?>
    <li><a class="userbar"><i class="fa-solid fa-user-secret"></i> Hallo <?php echo $userName ?></a></li>
    <?php endif ?>
    <?php if ($role === 'EMPLOYEE') : ?>
    <li><a class="userbar"><i class="fa-solid fa-user-clock"></i> Hallo <?php echo $userName ?></a></li>
    <?php endif ?>
    <?php if ($role === 'CUSTOMER') : ?>
    <li><a class="userbar"><i class="fa-solid fa-user"></i> Hallo <?php echo $userName ?></a></li>
    <?php endif ?>
    <?php if ($role === 'ADMIN') : ?>
    <li><a class="userbar" href="/views/dashboard.php"><i class="fa-solid fa-table-cells"></i> Dashboard</a></li>
    <?php endif ?>
    <?php if ($role === 'EMPLOYEE' || $role === 'ADMIN') : ?>
    <li><a class="userbar" href="/views/newPost.php"><i class="fa-solid fa-square-plus"></i> Neuen Post</a></li>
    <li><a class="userbar" href="/views/post-list.php"><i class="fa-solid fa-rectangle-list"></i>Postliste</a></li>
    <li><a class="userbar" href="/views/newProduct.php"><i class="fa-solid fa-square-plus"></i> Neues Produkt</a></li>
    <li><a class="userbar" href="/views/product-list.php"><i class="fa-solid fa-rectangle-list"></i>Produktliste</a>
    </li>
    <?php endif ?>
    <li><a class="userbar" href="/views/orders.php"><i class="fa-solid fa-receipt"></i> Bestellungen</a></li>
  </ul>

  <?php endif ?>
</div>