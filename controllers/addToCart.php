<?php
require_once __DIR__ . '/../helpers/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/views/products.php');
}

require_once __DIR__ . '/../helpers/nonUserRedirect.php';

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['user_id'];
$productId = $_POST['id'];
$quantity = '1';

$addedToCart = add_to_cart($userId, $productId, $quantity);

if ($addedToCart === false) {
  echo 'Nicht zum Warenkorb hinzugefügt!';
  header('Location: ' . '/views/products.php');
}

header('Location: ' . '/views/products.php');