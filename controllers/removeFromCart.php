<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

require_once __DIR__ . '/../models/cart.php';

$userId = $_SESSION['user_id'];

$productId = $_POST['productId'];
$get_quantity = get_quantity_from_cart($productId);

$removeItem = remove_product_from_cart($userId, $productId, $get_quantity);

header('Location: ' . '/views/cart.php');