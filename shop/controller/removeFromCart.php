<?php
session_start();

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/view/login.php">einloggen</a>');
}

require_once __DIR__ . '/../model/cart.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);

$productId = $_POST['productId'];

$removeItem = remove_product_from_cart($userId, $productId);

header('Location: ' . '/view/cart.php');