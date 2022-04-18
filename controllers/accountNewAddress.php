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

  $_SESSION['address']['city'] = $city ;
  $_SESSION['address']['street'] = $street ;
  $_SESSION['address']['streetNumber'] = $streetNumber ;
  $_SESSION['address']['zip'] = $zipCode ;
  
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
    header('Location: ' . '/views/account.php');
    exit();
  }
  
  if (count($errors) === 0) {
    $newDeliveryAddress = save_delivery_address($userId, $city, $street, $streetNumber, $zipCode);
    unset($_SESSION['addresss']);
    $_SESSION['success']['account-new-address'] = 'Neue Adresse hinzugefügt';
    header('Location: ' . '/views/account.php');
    exit();
  }
  
  header('Location: ' . '/views/account.php');
}