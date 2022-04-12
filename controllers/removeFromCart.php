<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['userId'];

$productId = $_POST['productId'];
$get_quantity = get_quantity_from_cart($productId);

$removeItem = remove_product_from_cart($userId, $productId, $get_quantity);

header('Location: ' . '/views/cart.php');