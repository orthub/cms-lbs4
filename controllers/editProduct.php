<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../models/userRights.php';


if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role !== 'CUSTOMER') {
    require_once __DIR__ . '/../helpers/session.php';
    $product_slug = htmlspecialchars($_POST['edit-product']);
    $edit_product = get_product_by_slug($product_slug);
    $_SESSION['edit-product'] = $edit_product;

    header('Location: ' . '/views/editProduct.php');
  }

}