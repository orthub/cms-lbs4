<?php

require_once __DIR__ . '/../models/products.php';
$products = get_all_live_products();

$categories = get_categories();

if(isset($_GET['cat'])){
  $category_available = false;
  $get_category = $_GET['cat'];
  $category_products = get_products_from_category($get_category);
  if(!empty($category_products)) {
    $category_available = true;
  }
}