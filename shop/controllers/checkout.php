<?php
session_start();
unset($_SESSION['before_post']);
unset($_SESSION['in_post']);
unset($_SESSION['order_saved']);
unset($_SESSION['cart_products_saved']);
unset($_SESSION['cart_products_deleted']);
if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/shop/views/login.php');
}

require_once __DIR__ . '/../models/checkout.php';
require_once __DIR__ . '/../models/cart.php';
$_SESSION['before_post'] = 'NOT IN POST';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  unset($_SESSION['before_post']);
  $_SESSION['in_post'] = 'IN POST';
  $deliveryAddress = $_SESSION['deliveryId'];
  $addressId = $_POST['deliveryId'];
  $_SESSION['deliveryAddressId'] = $addressId;
  $userId = $_SESSION['userId'];
  $userId = str_replace('_loggedIn', '', $userId);

  $createOrderId = $userId . rand(1, 255);
  $orderId = $createOrderId . $userId;

  // $saveOrderProducts = false;
  // $deleteCart = false;

  // order speichern
  $saveOrder = save_order($userId, $orderId, $addressId);
  // echo gettype($saveOrder);
  // if ($saveOrder === 0) {
  //   $_SESSION['order_saved'] = 'ORDER SAVED';
  // }
  // echo $_SESSION['order_saved'];
  // exit();
  // produkte vom warenkorb speichern
  $saveOrderProducts = save_order_products($userId, $orderId);
  // if ($saveOrder === true) {
  //   $_SESSION['cart_products_saved'] = 'CART PRODUCTS SAVED';
  // }

  // warenkorb leeren
  $deleteCart = delete_products_from_cart($userId);
  // if ($saveOrderProducts === true) {
  //   $_SESSION['cart_products_deleted'] = 'CART PRODUCTS DELETED';
  // }

  // bei erfolg -> dankesseite
  header('Location: ' . '/shop/views/thankyou.php');
  if ($deleteCart === true) {
  }

  // fehler beim erzeugen der bestellung
  // if ($deleteCart === false) {
  //   header('Location: ' . '/shop/views/checkout.php');
  // }
}


$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);


$deliveryAddress = delivery_address_for_order($userId, $_SESSION['deliveryId']);
$deliveryName = username_for_order($userId);