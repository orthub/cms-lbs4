<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = $_SESSION['userId'];
  $deliveryId = filter_input(INPUT_POST, 'deliveryId', FILTER_SANITIZE_SPECIAL_CHARS);
  $_SESSION['deliveryId'] = $deliveryId;
  
  header('Location: ' . '/views/checkout.php');
}