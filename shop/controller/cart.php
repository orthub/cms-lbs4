<?php

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/view/login.php">einloggen</a>');
}

require_once __DIR__ . '/../model/cart.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);

$totalPrice = 0;
$cartItems = get_cart_products_for_user($userId);