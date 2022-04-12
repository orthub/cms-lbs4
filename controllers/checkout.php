<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/views/login.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = $_SESSION['userId'];
  $deliveryId = filter_input(INPUT_POST, 'deliveryId', FILTER_SANITIZE_SPECIAL_CHARS);
  $_SESSION['deliveryId'] = $deliveryId;
  
  require_once __DIR__ . '/../models/checkout.php';
  require_once __DIR__ . '/../models/cart.php';
  
  $deliveryName = username_for_order($userId);
  $deliveryAddress = delivery_address_for_order($userId, $deliveryId);
  
  $_SESSION['checkout']['deliveryAddress'] = $deliveryAddress;
  $_SESSION['checkout']['deliveryName'] = $deliveryName;
  
  $totalPrice = $_SESSION['totalPrice'] * 100;
  
  // erzeugen einer zufallszahl für die bestellung
  $randomOrderId = date('dmYHi');
  // bestellungs id zusammensetzen mit der zufallszahl und user id
  $orderId = $randomOrderId . $userId;
  $_SESSION['order_id'] = $orderId;
  
  // bestellung speichern
  $saveOrder = save_order($userId, $orderId, $deliveryId, $totalPrice);  
  
  // produkte vom warenkorb speichern
  $saveOrderProducts = save_order_products($userId, $orderId);
  
  // warenkorb leeren
  $deleteCartProducts = delete_products_from_cart($userId);
 
  
  unset($orderId);
  unset($totalPrice);
  unset($userId);

  header('Location: ' . '/views/checkout.php');
}







  
  // $deliveryAddress = delivery_address_for_order($userId, $_SESSION['deliveryId']);
  
  
  
  // echo gettype($saveOrder);
  // if ($saveOrder === 0) {
  //   $_SESSION['order_saved'] = 'ORDER SAVED';
  // }
  // echo $_SESSION['order_saved'];
  // exit();
  // if ($saveOrder === true) {
  //   $_SESSION['cart_products_saved'] = 'CART PRODUCTS SAVED';
  // }

  // if ($saveOrderProducts === true) {
  //   $_SESSION['cart_products_deleted'] = 'CART PRODUCTS DELETED';
  // }

  
  
  


  // fehler beim erzeugen der bestellung
  // if ($deleteCart === false) {
  //   header('Location: ' . '/shop/views/checkout.php');
  // }