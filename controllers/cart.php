<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['user_id'];

$totalPrice = 0;
$cartItems = get_cart_products_for_user($userId);
$noItems = false;
$noItems = count($cartItems);
if ($noItems === 0) {
  $noItems = true;
}