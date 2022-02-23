<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/shop');
}

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/shop/views/login.php');
}

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);
$productId = $_POST['id'];
$quantity = '1';

$addedToCart = add_to_cart($userId, $productId, $quantity);

if ($addedToCart === false) {
  echo 'Nicht zum Warenkorb hinzugefügt!';
  header('Location: ' . '/shop');
}

header('Location: ' . '/shop');