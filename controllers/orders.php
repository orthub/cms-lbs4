<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/../models/orders.php';

$userId = $_SESSION['userId'];

$orders = get_order_overview_for_user($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $order_id = $_POST['order_id'];
  require_once __DIR__ . '/../lib/sessionHelper.php';
  require_once __DIR__ . '/invoice.php';
}