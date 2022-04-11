<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/views/products.php');
}

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/views/login.php');
}

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['userId'];
$productId = $_POST['id'];
$quantity = '1';

$addedToCart = add_to_cart($userId, $productId, $quantity);

if ($addedToCart === false) {
  echo 'Nicht zum Warenkorb hinzugefügt!';
  header('Location: ' . '/views/products.php');
}

header('Location: ' . '/views/products.php');