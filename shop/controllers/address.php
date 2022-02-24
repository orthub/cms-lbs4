<?php
if (session_start() === false) {
  session_start();
}

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/shop/views/login.php">einloggen</a>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = $_SESSION['userId'];
  $userId = str_replace('_loggedIn', '', $userId);
  $deliveryId = filter_input(INPUT_POST, 'deliveryId', FILTER_SANITIZE_SPECIAL_CHARS);
  $_SESSION['deliveryId'] = $deliveryId;

  header('Location: ' . '/shop/views/checkout.php');
}