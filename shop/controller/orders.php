<?php
session_start();
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/view/login.php">einloggen</a>');
}

require_once __DIR__ . '/../model/orders.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);

$orders = get_orders_for_user($userId);