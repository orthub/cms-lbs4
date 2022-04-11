<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../models/userRights.php';


if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($role === 'CUSTOMER') {
    header('Location: ' . '/');
  }

  $product_id = filter_input(INPUT_GET, 'prodid', FILTER_SANITIZE_SPECIAL_CHARS);
  $product_status = filter_input(INPUT_GET, 'current', FILTER_SANITIZE_SPECIAL_CHARS);
  $product_slug = filter_input(INPUT_GET, 'slug', FILTER_SANITIZE_SPECIAL_CHARS);
  
  if ($product_status === 'LIVE'){
    $new_status = 'DRAFT';
    $changeProductStatus = change_product_status_by_id($product_id, $new_status);
    if ($changeProductStatus) {
      $_SESSION['edit-product']['status'] = 'DRAFT';
      header('Location: ' . '/views/editProduct.php');
      exit();
    }
  }
  
  if ($product_status = 'DRAFT') {
    $new_status = 'LIVE';
    $changeProductStatus = change_product_status_by_id($product_id, $new_status);
    if ($changeProductStatus) {
      $_SESSION['edit-product']['status'] = 'LIVE';
      header('Location: ' . '/views/editProduct.php');
      exit();
    }
  }
  
  } else {
    header('Location: ' . '/');
}