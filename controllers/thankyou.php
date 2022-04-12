<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/createInvoice.php';

unset($_SESSION['totalPrice']);
unset($_SESSION['checkout']);
unset($_SESSION['order_id']);
unset($_SESSION['deliveryId']);

header('Location: ' . '/views/thankyou.php');