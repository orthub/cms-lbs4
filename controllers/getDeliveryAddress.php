<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';
require_once __DIR__ . '/../models/addresses.php';

$userId = $_SESSION['user_id'];


$deliveryAddress = get_delivery_address($userId);