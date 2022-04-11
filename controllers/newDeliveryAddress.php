<?php
session_start();
unset($_SESSION['errors']);
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}

require_once __DIR__ . '/../models/addresses.php';

$userId = $_SESSION['userId'];
$city = $_POST['city'];
$street = $_POST['street'];
$streetNumber = $_POST['streetNumber'];
$zipCode = $_POST['zip'];

$newDeliveryAddress = save_delivery_address($userId, $city, $street, $streetNumber, $zipCode);

if ($newDeliveryAddress === false) {
  $_SESSION['errors'] = 'Neue Adresse nicht angelegt!';
  header('Location: ' . '/views/address.php');
}

header('Location: ' . '/views/address.php');