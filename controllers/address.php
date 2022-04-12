<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userId = $_SESSION['user_id'];
  $deliveryId = filter_input(INPUT_POST, 'deliveryId', FILTER_SANITIZE_SPECIAL_CHARS);
  $_SESSION['deliveryId'] = $deliveryId;
  
  header('Location: ' . '/views/checkout.php');
}