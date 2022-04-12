<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../models/userRights.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../helpers/session.php';

    $productId = htmlspecialchars($_POST['productId']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $category = htmlspecialchars($_POST['category']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $status = filter_input(INPUT_POST, 'productStatus', FILTER_SANITIZE_SPECIAL_CHARS);

    $save_product = save_edited_product($productId, $title, $description, $price, $category, $quantity, $status);

    if ($save_product) {
      unset($_SESSION['edit-product']);
      header('Location: ' . '/views/product-list.php');
    }


  }

}