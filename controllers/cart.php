<?php
require_once __DIR__ . '/../helpers/session.php';
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['userId'];

$totalPrice = 0;
$cartItems = get_cart_products_for_user($userId);
$noItems = false;
$noItems = count($cartItems);
if ($noItems === 0) {
  $noItems = true;
}