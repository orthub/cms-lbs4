<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';
require_once __DIR__ . '/../models/orders.php';

$userId = $_SESSION['user_id'];

$orders = get_order_overview_for_user($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $order_id = $_POST['order_id'];
  require_once __DIR__ . '/../helpers/session.php';
  require_once __DIR__ . '/invoice.php';
}