<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/');
}

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/view/login.php');
}

require_once __DIR__ . '/../model/cart.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);
$productId = $_POST['id'];
$quantity = '1';

$addedToCart = add_to_cart($userId, $productId, $quantity);

if ($addedToCart === false) {
  echo 'Nicht zum Warenkorb hinzugefügt!';
  header('Location: ' . '/');
}

header('Location: ' . '/');