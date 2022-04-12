<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../models/userRights.php';

// if (!isset($_SESSION['userId'])) {
//   header('Location: ' . '/');
// }

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../helpers/session.php';
    $productId = htmlspecialchars($_POST['delete-product']);

    $delete_product = delete_product_by_id($productId);

    if ($delete_product) {
      header('Location: ' . '/views/product-list.php');
    }

  }

}