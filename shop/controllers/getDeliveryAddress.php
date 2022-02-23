<?php
session_start();
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/../models/addresses.php';

$userId = $_SESSION['userId'];
$userId = str_replace('_loggedIn', '', $userId);


$deliveryAddress = get_delivery_address($userId);