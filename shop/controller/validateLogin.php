<?php
session_start();

$valideEmail = false;
$validePassword = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/');
}

require_once __DIR__ . '/../model/login.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
  $_SESSION['errors']['email'] = 'Email erforderlich';
}

if (empty($password)) {
  $_SESSION['errors']['password'] = 'Passwort erforderlich';
}

if (!empty($_SESSION['errors'])) {
  header('Location: ' . '/view/login.php');
}


$verify = get_login($email);

if ($email === $verify[0]['email']) {
  $valideEmail = true;
}

if ($valideEmail === true) {
  password_verify($password, $verify[0]['password']);
  $validePassword = true;
}

if ($valideEmail && $validePassword) {
  // session_start();
  $_SESSION['userId'] = $verify[0]['id'] . '_loggedIn';
  header('Location: ' . '/');
}