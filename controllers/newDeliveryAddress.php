<?php
require_once __DIR__ . '/../helpers/session.php';
unset($_SESSION['errors']);
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__ . '/../helpers/session.php';
  $errors = [];
  require_once __DIR__ . '/../models/addresses.php';

  $userId = $_SESSION['user_id'];
  
  $city = htmlspecialchars(filter_input(INPUT_POST, 'city'));
  $street = htmlspecialchars(filter_input(INPUT_POST, 'street'));
  $streetNumber = htmlspecialchars(filter_input(INPUT_POST, 'streetNumber'));
  $zipCode = htmlspecialchars(filter_input(INPUT_POST, 'zip'));

  if ((bool)$city === false) {
    $_SESSION['error']['new-city'] = 'Bitte Stadt angeben';
    $errors[] = 1;
  }

  if ((bool)$street === false) {
    $_SESSION['error']['new-street'] = 'Bitte Straße angeben';
    $errors[] = 1;
  }

  if ((bool)$streetNumber === false) {
    $_SESSION['error']['new-streetNumber'] = 'Bitte Straßennummer angeben';
    $errors[] = 1;
  }

  if ((bool)$zipCode === false) {
    $_SESSION['error']['new-zip'] = 'Bitte Postleitzahl angeben';
    $errors[] = 1;
  }

  if (count($errors) > 0) {
    
    header('Location: ' . '/views/address.php');
  }

  if (count($errors) === 0) {
      $newDeliveryAddress = save_delivery_address($userId, $city, $street, $streetNumber, $zipCode);
     
      if ($newDeliveryAddress === false) {
        $_SESSION['error']['no-new-address'] = 'Neue Adresse konnte nicht angelegt werden, versuchen sie es später noch einmal!';
        
        header('Location: ' . '/views/address.php');
    }
  }
  
  header('Location: ' . '/views/address.php');
}