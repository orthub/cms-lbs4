<?php
session_start();
unset($_SESSION['before_post']);
unset($_SESSION['in_post']);
unset($_SESSION['order_saved']);
unset($_SESSION['cart_products_saved']);
unset($_SESSION['cart_products_deleted']);
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/view/login.php">einloggen</a>');
}

require_once __DIR__ . '/../model/checkout.php';
require_once __DIR__ . '/../model/cart.php';
$_SESSION['before_post'] = 'NOT IN POST';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['in_post'] = 'IN POST';
  $deliveryAddress = $_SESSION['deliveryId'];
  $addressId = $_POST['deliveryId'];
  $_SESSION['deliveryAddressId'] = $addressId;
  $userId = $_SESSION['userId'];
  $userId = str_replace('_loggedIn', '', $userId);

  $createOrderId = $userId . rand(1, 255);
  $orderId = $createOrderId;

  $saveOrderProducts = false;
  $deleteCart = false;


  // order speichern
  $saveOrder = save_order($userId, $orderId, $addressId);
  echo gettype($saveOrder);
  if ($saveOrder == true) {
    $_SESSION['order_saved'] = 'ORDER SAVED';
  }


  // produkte vom warenkorb speichern
  if ($saveOrder == true) {
    $saveOrderProducts = save_order_products($userId, $orderId);
    $_SESSION['cart_products_saved'] = 'CART PRODUCTS SAVED';
  }

  // warenkorb leeren
  if ($saveOrderProducts == true) {
    $deleteCart = delete_products_from_cart($userId);
    $_SESSION['cart_products_deleted'] = 'CART PRODUCTS DELETED';
  }

  // bei erfolg -> dankesseite
  if ($deleteCart == true) {
    header('Location: ' . '/view/thankyou.php');
  }

  // fehler beim erzeugen der bestellung
  if ($deleteCart == false) {
    header('Location: ' . '/view/checkout.php');
  }
}


$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);


$deliveryAddress = delivery_address_for_order($userId, $_SESSION['deliveryId']);
$deliveryName = username_for_order($userId);