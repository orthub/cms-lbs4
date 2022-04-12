<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

// Rechnung erstellen und in "/storage/{user_id}/" abspeichern
require_once __DIR__ . '/createInvoice.php';
// kurze pause damit die rechnung sicher abgespeichert wurde
sleep(1);
// versenden der erstellten email
require_once __DIR__ . '/sendInvoice.php';

// löschen der session variablen
unset($_SESSION['totalPrice']);
unset($_SESSION['checkout']);
unset($_SESSION['order_id']);
unset($_SESSION['deliveryId']);
unset($_SESSION['base-order']);
unset($_SESSION['deliveryAddressId']);
unset($_SESSION['order-products-quantity']);

// umleitung zur dankesseite
header('Location: ' . '/views/thankyou.php');