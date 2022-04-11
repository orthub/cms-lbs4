<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

$validateFirstName = false;
$validateLastName = false;
$valideEmail = false;
$validePassword = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/views/login.php');
}
unset($_SESSION['errors']);
require_once __DIR__ . '/../models/register.php';

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($firstName)) {
  $_SESSION['errors']['firstName'] = 'Vorname erforderlich';
  $error = true;
}

if (empty($lastName)) {
  $_SESSION['errors']['lastName'] = 'Nachname erforderlich';
  $error = true;
}

if (empty($email)) {
  $_SESSION['errors']['email'] = 'Email erforderlich';
  $error = true;
}

if (empty($password)) {
  $_SESSION['errors']['password'] = 'Passwort erforderlich';
  $error = true;
}

if (!empty($_SESSION['errors'])) {
  header('Location: ' . '/views/register.php');
  exit();
}

if ($error === false) {
  $register = register_account($firstName, $lastName, $email, $password);
}


if ($register === false) {
  $_SESSION['errors']['register'] = 'Registrierung fehlerhaft.';
  header('Location: ' . '/views/register.php');
}

header('Location: ' . '/views/login.php');